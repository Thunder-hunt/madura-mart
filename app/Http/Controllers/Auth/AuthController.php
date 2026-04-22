<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ─── Tampilkan form login ────────────────────────────────────────────────
    public function showLogin()
    {
        if (auth()->check()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    // ─── Proses login ────────────────────────────────────────────────────────
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()
            ->withErrors(['email' => 'Email atau password yang Anda masukkan salah.'])
            ->onlyInput('email');
    }

    // ─── Tampilkan form register ─────────────────────────────────────────────
    public function showRegister()
    {
        if (auth()->check()) {
            return redirect('/dashboard');
        }
        return view('auth.register');
    }

    // ─── Proses register ─────────────────────────────────────────────────────
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => [
                'required', 'string', 'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'confirmed',
            ],
        ], [
            'password.min'       => 'Password minimal 8 karakter.',
            'password.regex'     => 'Password harus mengandung minimal 1 huruf kapital dan 1 angka.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'email.unique'       => 'Email sudah terdaftar. Gunakan email lain.',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'user',
        ]);

        Auth::login($user);

        return redirect('/dashboard')
            ->with('success', 'Selamat datang di Madura Mart, ' . $user->name . '!');
    }

    // ─── Logout ──────────────────────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda berhasil keluar. Sampai jumpa!');
    }
}
