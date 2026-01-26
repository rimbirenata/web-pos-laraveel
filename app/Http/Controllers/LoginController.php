<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function proses_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Username atau Password salah');
        }

        // ✅ SESSION LOGIN
        session()->put('login', true);
        session()->put('id_user', $user->id_user);
        session()->put('username', $user->username);
        session()->put('nama', $user->nama); // ⭐ INI YANG DIPAKAI STRUK

        return redirect('/dashboard');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
