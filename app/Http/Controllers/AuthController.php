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

        return redirect()->route('dashboard');
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
        $inputLower = strtolower($input);

        // 1. Cari user secara fleksibel & case-insensitive (kompatibel penuh dengan PostgreSQL Supabase dan MySQL)
        $user = User::whereRaw('LOWER(email) = ?', [$inputLower])
            ->orWhereRaw('LOWER(name) = ?', [$inputLower])
            ->first();

        // 2. Jika input adalah kata kunci 'admin' atau 'administrator', temukan akun admin
        if (! $user && in_array($inputLower, ['admin', 'administrator'])) {
            $user = User::where('role', 'admin')->first();
        }

        // 3. Jika input adalah kata kunci 'kasir' atau 'cashier', temukan akun kasir
        if (! $user && in_array($inputLower, ['kasir', 'cashier'])) {
            $user = User::whereIn('role', ['cashier', 'kasir'])
                ->orWhereRaw('LOWER(name) LIKE ?', ['%kasir%'])
                ->first();
        }

        // 4. Cek variasi email umum jika belum ketemu (misal admin@sipemma.com <-> admin@gmail.com)
        if (! $user && filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $altEmail = match ($inputLower) {
                'admin@gmail.com' => 'admin@sipemma.com',
                'admin@sipemma.com' => 'admin@gmail.com',
                default => null,
            };

            if ($altEmail) {
                $user = User::whereRaw('LOWER(email) = ?', [$altEmail])->first();
            }
        }

        // 5. Cek variasi kesalahan ketik huruf 'l' bukannya 'i' (misal dandlazaldane / azaldane -> azaidane)
        if (! $user) {
            $corrected = str_replace(
                ['azaldane', 'dandl', 'zaldane'],
                ['azaidane', 'dandi', 'zaidane'],
                $inputLower
            );

            if ($corrected !== $inputLower) {
                $user = User::whereRaw('LOWER(email) = ?', [$corrected])
                    ->orWhereRaw('LOWER(name) = ?', [$corrected])
                    ->first();
            }
        }

        // 6. Toleransi input awalan 'dand' untuk akun admin/dandi
        if (! $user && str_starts_with($inputLower, 'dand')) {
            $user = User::whereRaw('LOWER(email) LIKE ?', ['%azaidane%'])
                ->orWhereRaw('LOWER(email) LIKE ?', ['%dandi%'])
                ->first();
        }

        // Jika user ditemukan dan password cocok
        if ($user && Hash::check($password, $user->password)) {
            // Otomatis rehash jika password di DB masih plaintext atau format lama
            if (Hash::needsRehash($user->password) || $user->password === $password) {
                try {
                    $user->password = Hash::make($password);
                    $user->save();
                } catch (\Throwable) {
                }
            }

            Auth::login($user, $remember);
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        // Fallback standar Auth::attempt
        $isEmail = filter_var($input, FILTER_VALIDATE_EMAIL);
        $field = $isEmail ? 'email' : 'name';
        if (Auth::attempt([$field => $input, 'password' => $password], $remember)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
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
