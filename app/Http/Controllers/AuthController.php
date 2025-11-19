<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function tampil_login()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Cek role user
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang Admin!');
            } elseif ($user->role === 'pembimbing') {
                return redirect()->route('pembimbing.dashboard')->with('success', 'Selamat datang Pembimbing!');
            } elseif ($user->role === 'siswa') {
                return redirect()->route('siswa.dashboard')->with('success', 'Selamat datang Siswa!');
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors('Role pengguna tidak dikenal.');
            }
        }

        // Kalau gagal login
        return back()->withErrors([
            'email' => 'Email atau password anda salah.'
        ])->onlyInput('email');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('login')->with('success',  'Berhasil Logout');
        
    }
}
