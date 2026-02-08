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

        $labelPeriode = Carbon::parse($tanggal)
            ->translatedFormat('d F Y');

        // ambil transaksi + relasi barang
        $transaksi = Transaksi::with('detailTransaksi.barang')
            ->whereDate('tanggal_transaksi', $tanggal)
            ->get();

        $adaRugi = false;

        // hitung modal & untung
        $detail = $transaksi->map(function ($t) use (&$adaRugi) {

            $modal = 0;

            foreach ($t->detailTransaksi as $d) {
                if ($d->barang) {
                    $modal += $d->jumlah * $d->barang->harga_beli;
                }
            }

            $t->total_modal = $modal;
            $t->total_keuntungan = $t->total_bayar - $modal;

            if ($t->total_keuntungan < 0) {
                $adaRugi = true;
            }

            return $t;
        });

        // ringkasan
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
            'totalKeuntungan',
            'adaRugi'
        ));
    }
}
