<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Struk</title>

<style>
    body {
        font-family: monospace;
        font-size: 11px;
        margin: 0;
        padding: 0;
    }

    .struk {
        width: 220px;
        margin: auto;
    }

    .center {
        text-align: center;
    }

    .right {
        text-align: right;
    }

    .line {
        border-top: 1px dashed #000;
        margin: 6px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 1px 0;
        vertical-align: top;
    }
</style>
</head>

<body onload="window.print()">

<div class="struk">

    <div class="center">
        <strong>TOKO KABASA SERBA ADA</strong><br>
        jalanin aja dulu siapa tau nyaman<br>
        kecamatan selalu di kecewakan
    </div>

    <div class="line"></div>

    No : {{ $transaksi->id_transaksi }} <br>
    Tgl: {{ date('d/m/Y H:i', strtotime($transaksi->tanggal_transaksi)) }} <br>
    Kasir: {{ $transaksi->kasir ?? 'RIMBI RENATA' }}

    <div class="line"></div>

    <table>
        @foreach ($detail as $d)
        <tr>
            <td colspan="2">{{ $d->nama_barang }}</td>
        </tr>
        <tr>
            <td>{{ $d->jumlah }} x {{ number_format($d->harga_saat_beli,0,',','.') }}</td>
            <td class="right">{{ number_format($d->subtotal,0,',','.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <td><strong>TOTAL</strong></td>
            <td class="right"><strong>{{ number_format($transaksi->total_bayar,0,',','.') }}</strong></td>
        </tr>
        <tr>
            <td>BAYAR</td>
            <td class="right">{{ number_format($transaksi->jumlah_bayar,0,',','.') }}</td>
        </tr>
        <tr>
            <td>KEMBALI</td>
            <td class="right">{{ number_format($transaksi->kembalian,0,',','.') }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <div class="center">
        TERIMA KASIH TELAH BELANJA 🙏
        barang yang sudah di beli tidak bisa di kembalikan
    </div>

</div>

</body>
</html>
