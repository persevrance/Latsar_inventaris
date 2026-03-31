<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Base\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show login page
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        try {
            if (!Auth::attempt($validated)) {
                return back()
                    ->withInput()
                    ->withErrors(['email' => 'Email atau password salah']);
            }

            $request->session()->regenerate();

            return $this->redirectByRole(Auth::user());
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->withErrors(['system' => 'Terjadi kesalahan saat login']);
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Berhasil logout');
    }

    /**
     * Show register page (Admin only)
     */
    public function showRegister()
    {
        return view('admin.users.create');
    }

    /**
     * Handle register (Admin create user)
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'role' => ['required', 'in:admin,pegawai']
        ]);

        try {
            User::create([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
            ]);

            return redirect()->route('admin.dashboard')
                ->with('success', 'User berhasil ditambahkan');
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->withErrors(['system' => 'Gagal menambahkan user']);
        }
    }

    /**
     * Centralized role redirect
     */
    protected function redirectByRole($user)
    {
        return match ($user->role) {
            'admin' => redirect()
                ->route('admin.dashboard')
                ->with('success', 'Login berhasil sebagai admin'),

            'pegawai' => redirect()
                ->route('pegawai.dashboard')
                ->with('success', 'Login berhasil sebagai pegawai'),

            default => redirect('/')
        };
    }
}
