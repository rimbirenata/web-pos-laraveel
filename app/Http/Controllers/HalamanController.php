<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class HalamanController extends Controller
{
    public function dashboard()
    {
        // INFO CARD
        $totalBarang = Schema::hasTable('barang') ? DB::table('barang')->count() : 0;
        $totalKategori = Schema::hasTable('kategori') ? DB::table('kategori')->count() : 0;
        $totalPelanggan = Schema::hasTable('pelanggan') ? DB::table('pelanggan')->count() : 0;
        $totalTransaksi = Schema::hasTable('transaksi') ? DB::table('transaksi')->count() : 0;

        // GRAFIK 12 BULAN
        $bulan = [];
        $totalPenjualan = [];

        for ($i = 1; $i <= 12; $i++) {
            $bulan[] = Carbon::create()->month($i)->format('F');
            $totalPenjualan[$i] = 0;
        }

        if (Schema::hasTable('transaksi')) {
            $grafik = DB::table('transaksi')
                ->selectRaw('MONTH(tanggal_transaksi) as bulan, SUM(total_bayar) as total')
                ->groupByRaw('MONTH(tanggal_transaksi)')
                ->get();

            foreach ($grafik as $g) {
                $totalPenjualan[$g->bulan] = $g->total;
            }
        }

        $totalPenjualan = array_values($totalPenjualan);

        // TRANSAKSI TERAKHIR
        $transaksiTerakhir = Schema::hasTable('transaksi')
            ? DB::table('transaksi')
                ->leftJoin('pelanggan', 'pelanggan.id_pelanggan', '=', 'transaksi.id_pelanggan')
                ->select(
                    'transaksi.tanggal_transaksi',
                    DB::raw('COALESCE(pelanggan.nama_pelanggan, "Pelanggan Umum") as nama_pelanggan'),
                    'transaksi.total_bayar'
                )
                ->orderByDesc('transaksi.tanggal_transaksi')
                ->limit(5)
                ->get()
            : [];

        return view('dashboard.index', compact(
            'totalBarang',
            'totalKategori',
            'totalPelanggan',
            'totalTransaksi',
            'bulan',
            'totalPenjualan',
            'transaksiTerakhir'
        ));
    }
}
