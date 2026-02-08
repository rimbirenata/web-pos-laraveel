<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;

class LaporanController extends Controller
{
public function penjualan(Request $request)
{
    $periode = $request->periode ?? 'harian';
    $tanggal = $request->tanggal ?? date('Y-m-d');

    $labelPeriode = \Carbon\Carbon::parse($tanggal)
        ->translatedFormat('d F Y');

    $transaksi = \App\Models\Transaksi::with('detailTransaksi.barang')
        ->whereDate('tanggal_transaksi', $tanggal)
        ->get();

    $detail = $transaksi->map(function ($t) {
        $modal = 0;

        foreach ($t->detailTransaksi as $d) {
            $modal += $d->jumlah * $d->barang->harga_beli;
        }

        $t->total_modal = $modal;
        $t->total_keuntungan = $t->total_bayar - $modal;

        return $t;
    });

    $totalTransaksi  = $detail->count();
    $totalBayar      = $detail->sum('total_bayar');
    $totalModal      = $detail->sum('total_modal');
    $totalKeuntungan = $totalBayar - $totalModal;

    return view('laporan.index', compact(
        'periode',
        'tanggal',
        'labelPeriode',
        'detail',
        'totalTransaksi',
        'totalBayar',
        'totalModal',
        'totalKeuntungan'
    ));
}

}