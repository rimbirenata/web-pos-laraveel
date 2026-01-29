<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // ⬅️ TARUH DI ATAS SINI

class UserController extends Controller
{
    public function index()
    {
        $user = DB::table('user')->get();
        return view('user', compact('user'));
    }

    public function form_tambah()
    {
        return view('tambah-user');
    }

    // 🔥 INI YANG KAMU TANYAIN
    public function simpan_user(Request $request)
    {
        $request->validate([
            'username'      => 'required|unique:user,username',
            'password'      => 'required',
            'nama_lengkap'  => 'required',
        ]);

        DB::table('user')->insert([
            'username'     => $request->username,
            'password'     => Hash::make($request->password), // ✅ HASH DI SINI
            'nama_lengkap' => $request->nama_lengkap,
        ]);

        return redirect('/user')->with('success','User berhasil ditambahkan');
    }
}
