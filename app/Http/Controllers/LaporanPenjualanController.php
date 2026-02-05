<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function penjualan(Request $request)
    {
        $periode = $request->periode ?? 'harian';
        $tanggal = $request->tanggal ?? date('Y-m-d');

        $query = DB::table('transaksi as t')
            ->join('detail_transaksi as dt', 'dt.transaksi_id', '=', 't.id')
            ->join('barang as b', 'b.id', '=', 'dt.barang_id');

        // FILTER PERIODE
        if ($periode == 'harian') {
            $query->whereDate('t.tanggal_transaksi', $tanggal);
            $labelPeriode = Carbon::parse($tanggal)->translatedFormat('d F Y');
        }
        elseif ($periode == 'bulanan') {
            $query->whereMonth('t.tanggal_transaksi', date('m', strtotime($tanggal)))
                  ->whereYear('t.tanggal_transaksi', date('Y', strtotime($tanggal)));
            $labelPeriode = Carbon::parse($tanggal)->translatedFormat('F Y');
        }
        elseif ($periode == 'tahunan') {
            $query->whereYear('t.tanggal_transaksi', $tanggal);
            $labelPeriode = $tanggal;
        }

        // DATA DETAIL
        $detail = $query
            ->select(
                't.tanggal_transaksi',
                DB::raw('SUM(dt.harga_jual * dt.qty) as total_bayar'),
                DB::raw('SUM((dt.harga_jual - b.harga_beli) * dt.qty) as total_keuntungan')
            )
            ->groupBy('t.id', 't.tanggal_transaksi')
            ->get();

        // RINGKASAN
        $totalTransaksi   = $detail->count();
        $totalBayar       = $detail->sum('total_bayar');
        $totalKeuntungan  = $detail->sum('total_keuntungan');

        return view('laporan.index', compact(
            'detail',
            'totalTransaksi',
            'totalBayar',
            'totalKeuntungan',
            'periode',
            'tanggal',
            'labelPeriode'
        ));
    }
}
