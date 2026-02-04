<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        // =====================================
        // SETTING MINGGU (SENIN - MINGGU)
        // =====================================
        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);

        // =====================================
        // AMBIL INPUT
        // =====================================
        $periode = $request->periode ?? 'harian';

        $tanggal = $request->tanggal
            ? Carbon::parse($request->tanggal)
            : Carbon::today();

        // =====================================
        // BASE QUERY
        // =====================================
        $baseQuery = DB::table('transaksi')
            ->join(
                'detail_transaksi',
                'detail_transaksi.id_transaksi',
                '=',
                'transaksi.id_transaksi'
            )
            ->join(
                'barang',
                'barang.id_barang',
                '=',
                'detail_transaksi.id_barang'
            );

        // =====================================
        // FILTER PERIODE
        // =====================================
        if ($periode === 'harian') {

            $baseQuery->whereDate(
                'transaksi.tanggal_transaksi',
                $tanggal->format('Y-m-d')
            );

            $labelPeriode = $tanggal->translatedFormat('d F Y');

        } elseif ($periode === 'mingguan') {

            // 🔥 FIX UTAMA (DATETIME AMAN)
            $awalMinggu  = $tanggal->copy()->startOfWeek()->startOfDay();
            $akhirMinggu = $tanggal->copy()->endOfWeek()->endOfDay();

            $baseQuery->whereBetween(
                'transaksi.tanggal_transaksi',
                [$awalMinggu, $akhirMinggu]
            );

            $labelPeriode = 'Minggu '
                . $awalMinggu->translatedFormat('d F')
                . ' - '
                . $akhirMinggu->translatedFormat('d F Y');

        } elseif ($periode === 'bulanan') {

            $baseQuery->whereMonth(
                'transaksi.tanggal_transaksi',
                $tanggal->month
            )->whereYear(
                'transaksi.tanggal_transaksi',
                $tanggal->year
            );

            $labelPeriode = $tanggal->translatedFormat('F Y');

        } else { // tahunan

            $baseQuery->whereYear(
                'transaksi.tanggal_transaksi',
                $tanggal->year
            );

            $labelPeriode = $tanggal->year;
        }

        // =====================================
        // RINGKASAN
        // =====================================
        $ringkasan = (clone $baseQuery)
            ->selectRaw('
                COUNT(DISTINCT transaksi.id_transaksi) AS total_transaksi,
                COALESCE(
                    SUM(detail_transaksi.jumlah * barang.harga_jual),
                    0
                ) AS total_bayar,
                COALESCE(
                    SUM(
                        (barang.harga_jual - COALESCE(barang.harga_modal, 0))
                        * detail_transaksi.jumlah
                    ),
                    0
                ) AS total_keuntungan
            ')
            ->first();

        // =====================================
        // DETAIL TRANSAKSI
        // =====================================
        $detail = (clone $baseQuery)
            ->select(
                'transaksi.id_transaksi',
                'transaksi.tanggal_transaksi',
                DB::raw('
                    SUM(detail_transaksi.jumlah * barang.harga_jual)
                    AS total_bayar
                '),
                DB::raw('
                    SUM(
                        (barang.harga_jual - COALESCE(barang.harga_modal, 0))
                        * detail_transaksi.jumlah
                    ) AS total_keuntungan
                ')
            )
            ->groupBy(
                'transaksi.id_transaksi',
                'transaksi.tanggal_transaksi'
            )
            ->orderBy('transaksi.tanggal_transaksi', 'DESC')
            ->get();

        // =====================================
        // KIRIM KE VIEW
        // =====================================
        return view('laporan.index', [
            'periode'         => $periode,
            'tanggal'         => $tanggal->format('Y-m-d'),
            'labelPeriode'    => $labelPeriode,
            'totalTransaksi'  => $ringkasan->total_transaksi ?? 0,
            'totalBayar'      => $ringkasan->total_bayar ?? 0,
            'totalKeuntungan' => $ringkasan->total_keuntungan ?? 0,
            'detail'          => $detail
        ]);
    }
}
