<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            // buat session
            session(['login berhasil' => true]);
            return redirect()->route('categories.index');
        }

        return redirect()->back()->with('error', 'Invalid credentials');

    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
