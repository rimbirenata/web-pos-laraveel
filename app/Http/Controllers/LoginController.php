<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // tampilkan halaman login
    public function index()
    {
        return view('login');
    }

    // proses login
    public function proses_login(Request $request)
    {
        // VALIDASI INPUT
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // DATA LOGIN
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        // PROSES LOGIN
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // CEK (boleh dihapus setelah berhasil)
            // dd(Auth::user());

            return redirect('/dashboard');
        }

        // JIKA GAGAL LOGIN
        return back()->with('error', 'Username atau password salah!');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
