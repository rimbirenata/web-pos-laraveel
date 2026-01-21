<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HalamanController extends Controller
{
    public function index()
    {
        // =============================
        // CEK LOGIN
        // =============================
        if (!session()->has('login')) {
            return redirect('/login');
        }

        // =============================
        // INFO CARD (AMAN)
        // =============================
        $totalBarang = Schema::hasTable('barang')
            ? DB::table('barang')->count()
            : 0;

        $totalKategori = Schema::hasTable('kategori')
            ? DB::table('kategori')->count()
            : 0;

        $totalPelanggan = Schema::hasTable('pelanggan')
            ? DB::table('pelanggan')->count()
            : 0;

        $totalTransaksi = Schema::hasTable('transaksi')
            ? DB::table('transaksi')->count()
            : 0;

        // =============================
        // GRAFIK PENJUALAN (AMAN)
        // =============================
        $bulan = [];
        $totalPenjualan = [];

        if (Schema::hasTable('transaksi')) {
            $grafik = DB::table('transaksi')
                ->selectRaw('MONTH(tanggal_transaksi) as bulan, SUM(total_bayar) as total')
                ->groupBy(DB::raw('MONTH(tanggal_transaksi)'))
                ->orderBy(DB::raw('MONTH(tanggal_transaksi)'))
                ->get();

            foreach ($grafik as $g) {
                $bulan[] = date('F', mktime(0, 0, 0, $g->bulan, 1));
                $totalPenjualan[] = $g->total;
            }
        }

        // =============================
        // PRODUK TERLARIS (AMAN)
        // =============================
        $produkTerlaris = [];

        if (
            Schema::hasTable('detail_transaksi') &&
            Schema::hasTable('barang')
        ) {
            $produkTerlaris = DB::table('detail_transaksi')
                ->join('barang', 'barang.id_barang', '=', 'detail_transaksi.id_barang')
                ->select(
                    'barang.nama_barang',
                    DB::raw('SUM(detail_transaksi.jumlah) as total_terjual')
                )
                ->groupBy('barang.nama_barang')
                ->orderByDesc('total_terjual')
                ->limit(5)
                ->get();
        }

        // =============================
        // TRANSAKSI TERAKHIR (AMAN)
        // =============================
        $transaksiTerakhir = [];

        if (
            Schema::hasTable('transaksi') &&
            Schema::hasTable('pelanggan')
        ) {
            $transaksiTerakhir = DB::table('transaksi')
                ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'transaksi.id_pelanggan')
                ->select(
                    'transaksi.tanggal_transaksi',
                    'pelanggan.nama_pelanggan',
                    'transaksi.total_bayar'
                )
                ->orderByDesc('transaksi.tanggal_transaksi')
                ->limit(5)
                ->get();
        }

        return view('dashboard.index', compact(
            'totalBarang',
            'totalKategori',
            'totalPelanggan',
            'totalTransaksi',
            'bulan',
            'totalPenjualan',
            'produkTerlaris',
            'transaksiTerakhir'
        ));
    }
}
