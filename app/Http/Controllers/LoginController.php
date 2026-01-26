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

        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan');
        }
        

      
        // SIMPAN SESSION
        session([
            'login'   => true,
            'id'      => $user->id,
            'nama'    => $user->nama,
            'username'=> $user->username
        ]);

        return redirect('/dashboard');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
