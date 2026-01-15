<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->tanggal ?? Carbon::today()->toDateString();

        $transaksiHariIni = Transaksi::whereDate('tanggal_transaksi', $tanggal)->get();

        $totalPenjualan = $transaksiHariIni->sum('total_bayar');
        $totalKeuntungan = $transaksiHariIni->sum('total_keuntungan');
        $jumlahTransaksi = $transaksiHariIni->count();

        return view('laporan-penjualan', compact(
            'tanggal',
            'transaksiHariIni',
            'totalPenjualan',
            'totalKeuntungan',
            'jumlahTransaksi'
        ));
    }
}
