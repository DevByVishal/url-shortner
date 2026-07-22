<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index(){
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request){
        if (!Auth::attempt($request->only('email','password'))) {

            return back()->withErrors([
                'email'=>'Invalid credentials.'
            ]);
        }

        $request->session()->regenerate();
        return redirect()->intended(route('dashboard'));
        

        abort(403);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
