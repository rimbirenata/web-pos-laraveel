<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HalamanController extends Controller
{
   public function index(Request $request)
{
    $tanggal_awal  = $request->tanggal_awal;
    $tanggal_akhir = $request->tanggal_akhir;

    $query = DB::table('transaksi')
        ->selectRaw('DATE(tanggal_transaksi) as hari, SUM(total_bayar) as total')
        ->groupByRaw('DATE(tanggal_transaksi)')
        ->orderBy('hari', 'asc');

    if ($tanggal_awal && $tanggal_akhir) {
        $query->whereBetween('created_at', [
            $tanggal_awal . ' 00:00:00',
            $tanggal_akhir . ' 23:59:59'
        ]);
    }

    $data = $query->get();

    $hari = [];
    $total = [];

    foreach ($data as $d) {
        $hari[]  = $d->hari;
        $total[] = $d->total;
    }

    return view('dashboard', compact('hari', 'total', 'tanggal_awal', 'tanggal_akhir'));
}


}
