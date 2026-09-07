<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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
     * Tampilkan halaman lupa sandi.
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Kirim email link reset password.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Tampilkan halaman form reset password baru.
     */
    public function showResetPassword(Request $request, $token)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Proses update password baru dari reset link.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
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
            'password' => $validated['password'],
            'role' => 'admin', // Role diset menjadi admin sesuai instruksi
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
        $input = trim((string) $request->input('email', ''));
        $password = (string) $request->input('password', '');

        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        // Deteksi apakah input berupa email atau nama/username
        $isEmail = filter_var($input, FILTER_VALIDATE_EMAIL);
        $field = $isEmail ? 'email' : 'name';

        $credentials = [$field => $input, 'password' => $password];

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        // Cek alternatif jika pengguna memasukkan admin@gmail.com atau admin@sipemma.com
        if ($isEmail) {
            $altEmail = match (strtolower($input)) {
                'admin@gmail.com' => 'admin@sipemma.com',
                'admin@sipemma.com' => 'admin@gmail.com',
                default => null,
            };

            if ($altEmail && Auth::attempt(['email' => $altEmail, 'password' => $password], $remember)) {
                $request->session()->regenerate();

                return redirect()->route('dashboard');
            }
        }

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

        return redirect()->route('landing');
    }
}
