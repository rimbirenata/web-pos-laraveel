<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        $pelanggan = Pelanggan::all();
        return view('transaksi', compact('barang', 'pelanggan'));
    }

    public function proses(Request $request)
{
    $request->validate([
        'keranjang'    => 'required|array|min:1',
        'total_bayar'  => 'required|numeric|min:1',
        'jumlah_bayar' => 'required|numeric|min:1',
    ]);

    DB::beginTransaction();

    try {

        $transaksi = Transaksi::create([
            'id_pelanggan'      => $request->id_pelanggan,
            'tanggal_transaksi' => now(),
            'total_bayar'       => $request->total_bayar,
            'jumlah_bayar'      => $request->jumlah_bayar,
            'kembalian'         => $request->jumlah_bayar - $request->total_bayar,
            'total_keuntungan'  => 0,
        ]);

        foreach ($request->keranjang as $item) {

            $jumlah = (int) $item['jumlah'];
            if ($jumlah < 1) continue;

            $barang = Barang::where('id_barang', $item['id'])->firstOrFail();

            DetailTransaksi::create([
                'id_transaksi'    => $transaksi->id_transaksi,
                'id_barang'       => $barang->id_barang,
                'jumlah'          => $jumlah,
                'harga_saat_beli' => $barang->harga_jual,
                'subtotal'        => $barang->harga_jual * $jumlah,
            ]);

            $barang->stok -= $jumlah;
            $barang->save();
        }

        DB::commit();

        return redirect()->route('struk.cetak', [
    'id' => $transaksi->id_transaksi
]);

    } catch (\Exception $e) {
        DB::rollBack();
        dd($e->getMessage()); // ⬅️ JANGAN DIHAPUS SAAT TEST
    }
}

}
