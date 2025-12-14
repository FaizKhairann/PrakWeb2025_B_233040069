<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class loginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        //validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //logic login dengan  Auth:attempt
        if (Auth::attempt($request->only('email', 'password'))) {
            //login berhasil
            $request->session()->regenerate();
            return redirect()->intended('/posts');
        }

        //login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
