<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    //autentikasi manual sederhana
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        //Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //logic register : validasi, hash password, User::create
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //redirect ke login setelah register berhasil
        return redirect('/login')->with('success', 'Registrasi berhasil! Silahkan login.');
    }
}
