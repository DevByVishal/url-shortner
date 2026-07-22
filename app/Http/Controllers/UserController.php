<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where(
            'company_id',
            auth()->user()->company_id
        )
        ->latest()
        ->paginate(10);

        return view('users.index', compact('users'));
    }
}