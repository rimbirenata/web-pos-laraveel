<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi #{{ $transaksi->id_transaksi }}</title>
    <style>
        body { font-family: monospace; font-size: 12px; width: 220px; margin: 0 auto; padding: 5px; }
        hr { border: dashed 1px #000; margin: 4px 0; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 2px 0; text-align: left; }
        th.qty, td.qty { text-align: center; width: 30px; }
        th.harga, td.harga { text-align: right; width: 70px; }
        th.subtotal, td.subtotal { text-align: right; width: 70px; }
        .total { font-weight: bold; text-align: right; }
        .terimakasih { text-align: center; margin-top: 5px; }
    </style>
</head>
<body>

<p>
    No Transaksi: {{ $transaksi->id_transaksi }}<br>
    Tanggal: {{ date('d-m-Y H:i', strtotime($transaksi->tanggal_transaksi)) }}
</p>
<hr>

<table>
    <thead>
        <tr>
            <th>Barang</th>
            <th class="qty">Qty</th>
            <th class="harga">Harga</th>
            <th class="subtotal">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detail as $d)
        <tr>
            <td>{{ $d->nama_barang }}</td>
            <td class="qty">{{ $d->jumlah }}</td>
            <td class="harga">{{ number_format($d->harga_jual,0,',','.') }}</td>
            <td class="subtotal">{{ number_format($d->harga_jual * $d->jumlah,0,',','.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<hr>
<p class="total">
    Total Bayar : Rp {{ number_format($transaksi->total_bayar,0,',','.') }}<br>
    Uang Bayar : Rp {{ number_format($uangDibayar,0,',','.') }}<br>
    Kembalian  : Rp {{ number_format($kembalian,0,',','.') }}
</p>
<hr>
<p>Terima kasih atas kunjungannya!</p>


<script>
    window.print();
</script>

</body>
</html>
