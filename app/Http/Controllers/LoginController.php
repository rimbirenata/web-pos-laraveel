<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'login' => true,
                'id_user' => $user->id_user,
                'nama' => $user->nama,
                'username' => $user->username
            ]);

            return redirect('/dashboard');
        }

        return back()->with('error', 'Username atau password salah');
    }
}
  
