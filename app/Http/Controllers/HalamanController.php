<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HalamanController extends Controller
{
    public function dashboard()
    {
        // ================= CARD RINGKASAN =================
        $totalPelanggan = DB::table('pelanggan')->count();
        $totalBarang    = DB::table('barang')->count();
        $totalKategori  = DB::table('kategori')->count();
        $totalTransaksi = DB::table('penjualan')->count();

        // ================= GRAFIK PENJUALAN BULANAN =================
        $penjualan = DB::table('penjualan')
            ->selectRaw('MONTH(tanggal) as bulan, SUM(total) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bulan = [];
        $totalPenjualan = [];

        foreach ($penjualan as $p) {
            $bulan[] = date('F', mktime(0,0,0,$p->bulan,1));
            $totalPenjualan[] = $p->total;
        }

        // ================= PRODUK TERLARIS =================
        $produkTerlaris = DB::table('detail_penjualan')
            ->join('barang', 'barang.id_barang', '=', 'detail_penjualan.id_barang')
            ->select('barang.nama_barang', DB::raw('SUM(detail_penjualan.qty) as total'))
            ->groupBy('barang.nama_barang')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // ================= TRANSAKSI TERAKHIR =================
        $transaksiTerakhir = DB::table('penjualan')
            ->join('pelanggan','pelanggan.id','=','penjualan.id_pelanggan')
            ->select('penjualan.tanggal','pelanggan.nama_pelanggan','penjualan.total')
            ->orderByDesc('penjualan.tanggal')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'totalPelanggan',
            'totalBarang',
            'totalKategori',
            'totalTransaksi',
            'bulan',
            'totalPenjualan',
            'produkTerlaris',
            'transaksiTerakhir'
        ));
    }
}
