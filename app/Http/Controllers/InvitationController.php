<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Invitation;
use App\Models\User;
use App\Services\InvitationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class InvitationController extends Controller
{
    public function __construct(
        private InvitationService $invitationService
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Invitation List
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = auth()->user();

        $invitations = Invitation::with([
            'company',
            'inviter',
            'role',
        ])
        ->when(
            ! $user->hasRole('SuperAdmin'),
            function ($query) use ($user) {

                $query->where(
                    'company_id',
                    $user->company_id
                );

            }
        )
        ->latest()
        ->paginate(10);

        return view(
            'invitations.index',
            compact('invitations')
        );
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->hasRole('SuperAdmin')) {

            $roles = ['Admin'];

            $companies = Company::all();

        } elseif ($user->hasRole('Admin')) {

            $roles = ['Admin', 'Member'];

            $companies = collect([$user->company]);

        } else {

            abort(403);

        }

        return view('invitations.create', compact('roles', 'companies'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Only SuperAdmin and Admin can send invitations
        if (!$user->hasAnyRole(['SuperAdmin', 'Admin'])) {
            abort(403);
        }

        // SuperAdmin can invite only Admin
        if ($user->hasRole('SuperAdmin')) {

            $allowedRoles = ['Admin'];

        } else {

            // Admin can invite Admin or Member
            $allowedRoles = ['Admin', 'Member'];
        }

        // Basic validation
        $request->validate([
            'email' => 'required|email',
            'role' => 'required|in:' . implode(',', $allowedRoles),
            'company_id' => 'required|exists:companies,id',
        ]);

        // Admin can only invite into their own company
        if ($user->hasRole('Admin')) {

            if ($request->company_id != $user->company_id) {
                return back()->withErrors([
                    'company_id' => 'You can only invite users to your own company.'
                ]);
            }
        }

        // Prevent duplicate pending invitation
        $existingInvitation = Invitation::where('email', $request->email)
            ->where('company_id', $request->company_id)
            ->whereNull('accepted_at')
            ->first();

        if ($existingInvitation) {
            return back()->withErrors([
                'email' => 'An invitation has already been sent to this email.'
            ]);
        }
        $role = \Spatie\Permission\Models\Role::where('name', $request->role)->firstOrFail();
        if(!$role){
            abort(401);
        }
        // Create invitation
        $invitation = Invitation::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'invited_by' => auth()->id(),
            'role_id' => $role->id,
            'token' => Str::random(64),
            'expires_at' => now()->addDays(7),
        ]);

        return redirect()
            ->route('invitations.index')
            ->with('success', 'Invitation created successfully.');
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)
            ->whereNull('accepted_at')
            ->where('expires_at', '>', now())
            ->firstOrFail();

        return view('invitations.accept', compact('invitation'));
    }

    public function acceptStore(Request $request, $token)
    {
        $invitation = Invitation::where('token', $token)
            ->whereNull('accepted_at')
            ->where('expires_at', '>', now())
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Prevent email from being changed
        $user = User::create([
            'name' => $request->name,
            'email' => $invitation->email,
            'password' => Hash::make($request->password),
            'company_id' => $invitation->company_id,
        ]);

        // Assign invited role
        $user->assignRole($invitation->role);

        // Mark invitation as accepted
        $invitation->update([
            'accepted_at' => now(),
        ]);

        // Login user
        Auth::login($user);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Account created successfully.');
    }
}