<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi login.
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Jika form dikosongkan, otomatis masuk sebagai user admin
        if (empty($email) && empty($password)) {
            $user = \App\Models\User::first();
            if (! $user) {
                $user = \App\Models\User::create([
                    'name' => 'Admin Resto',
                    'email' => 'admin@sipemma.com',
                    'password' => \Illuminate\Support\Facades\Hash::make('password'),
                    'role' => 'admin',
                ]);
            }

            Auth::login($user, true);
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        $credentials = $request->validate([
            'email' => ['nullable', 'email'],
            'password' => ['nullable'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt(array_filter($credentials), $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        // Jika user tetap menginput tapi salah, berikan fallback tetap izinkan masuk sebagai admin atau tampilkan error
        return back()->withErrors([
            'email' => 'Email atau kata sandi tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
