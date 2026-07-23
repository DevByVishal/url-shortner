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
        // SuperAdmin can see all users
        $users = User::with('company')->latest()->get();
    } elseif ($user->hasRole('Admin')) {
        // Admin can see users from their own company
        $users = User::with('company')
            ->where('company_id', $user->company_id)
            ->latest()
            ->get();
    } else {
        abort(403);
    }

    return view('users.index', compact('users'));
}
}
