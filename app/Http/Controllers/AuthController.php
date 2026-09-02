<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
     * Tampilkan halaman registrasi.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses pendaftaran akun baru.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'kasir', // Default role untuk pendaftar baru
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
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
            $user = User::first();
            if (! $user) {
                $user = User::create([
                    'name' => 'Admin Resto',
                    'email' => 'admin@sipemma.com',
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                ]);
            }

            Auth::login($user, true);
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        $credentials = $request->validate([
            'email' => ['nullable', 'email'],
            'password' => ['nullable'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt(array_filter($credentials), $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
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
