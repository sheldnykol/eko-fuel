<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function Login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password'=> ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');

        }

        return back()->withErrors([
            'email' => 'Τα στοιχεία δεν ταιριάζουν με τα αρχεία μας.',

        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
