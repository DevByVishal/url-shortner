<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
{
    $user = auth()->user();

    if ($user->hasRole('SuperAdmin')) {

        // SuperAdmin can see all users from all companies
        $users = User::with('company')
            ->latest()
            ->paginate(10);

    } elseif ($user->hasRole('Admin')) {

        // Admin can see users from their own company only
        $users = User::with('company')
            ->where('company_id', $user->company_id)
            ->latest()
            ->paginate(10);

    } else {
        abort(403);
    }

    return view('users.index', compact('users'));
}
}
