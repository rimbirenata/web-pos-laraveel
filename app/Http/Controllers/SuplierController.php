<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    public function index()
    {
        // AMBIL SEMUA DATA SUPLIER
        $suplier = Suplier::all();

        // KIRIM KE VIEW suplier.blade.php
        return view('suplier', compact('suplier'));
    }

    public function destroy($id)
    {
        $suplier = Suplier::findOrFail($id);

        // CEK MASIH DIPAKAI BARANG
        if ($suplier->barang()->count() > 0) {
            return redirect()->back()->with(
                'error',
                'Data suplier tidak bisa dihapus karena masih terhubung dengan data barang'
            );
        }

        $suplier->delete();

        return redirect()->back()->with('success', 'Data suplier berhasil dihapus');
    }
}
