<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HalamanController extends Controller
{
    public function index()
    {
        // =============================
        // INFO CARD
        // =============================
        $totalBarang     = DB::table('barang')->count();
        $totalKategori   = DB::table('kategori')->count();
        $totalPelanggan  = DB::table('pelanggan')->count();
        $totalTransaksi  = DB::table('transaksi')->count();

        // =============================
        // GRAFIK PENJUALAN BULANAN
        // =============================
        $grafik = DB::table('transaksi')
            ->selectRaw('MONTH(tanggal_transaksi) as bulan, SUM(total_bayar) as total')
            ->groupBy(DB::raw('MONTH(tanggal_transaksi)'))
            ->orderBy(DB::raw('MONTH(tanggal_transaksi)'))
            ->get();

        $bulan = [];
        $totalPenjualan = [];

        foreach ($grafik as $g) {
            $bulan[] = date('F', mktime(0, 0, 0, $g->bulan, 1));
            $totalPenjualan[] = $g->total;
        }

        // =============================
        // PRODUK TERLARIS
        // =============================
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

        // =============================
        // TRANSAKSI TERAKHIR
        // =============================
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
