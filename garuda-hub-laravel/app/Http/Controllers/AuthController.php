<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:6|max:72',
            'role'     => 'required|in:klien,developer',
        ]);

        $data['email'] = strtolower($data['email']);
        User::create($data); // password otomatis di-hash oleh cast 'hashed'

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan masuk.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            return redirect()->route($user->role === 'admin' ? 'projects.index' : 'dashboard')
            ->with('success', 'Selamat datang kembali.');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('projects.index')->with('success', 'Anda telah keluar.');
    }
}
