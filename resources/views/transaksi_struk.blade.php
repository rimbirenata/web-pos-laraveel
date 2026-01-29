<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Struk Transaksi</title>

<style>
    body {
        font-family: monospace;
        font-size: 10px;
        background: #fff;
        margin: 0;
        padding: 0;
    }

    .struk {
        width: 220px; /* <<< INI KUNCINYA (58mm) */
        padding: 8px;
        margin: auto;
    }

    .center { text-align: center; }
    .right { text-align: right; }
    .bold { font-weight: bold; }

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

    @media print {
        body {
            margin: 0;
        }
    }
</style>
</head>

<body onload="window.print()">

<div class="struk">

    {{-- HEADER --}}
    <div class="center bold">TOKO KABASA</div>
    <div class="center">
        Jl. Raya Kabasa No.12<br>
        Malang - Jawa Timur<br>
        Telp: 0812-3456-6789
    </div>

    <div class="line"></div>

    {{-- INFO --}}
    <table>
        <tr>
            <td>Tgl</td>
            <td class="right">{{ date('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td class="right">{{ $kasir }}</td>
        </tr>

    </table>

    <div class="line"></div>

    {{-- BARANG --}}
    <table>
        @foreach($detail as $d)
        <tr>
            <td colspan="2">{{ $d->barang->nama_barang }}</td>
        </tr>
        <tr>
            <td>{{ $d->jumlah }} x {{ number_format($d->harga_saat_beli,0,',','.') }}</td>
            <td class="right">{{ number_format($d->subtotal,0,',','.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>

    {{-- TOTAL --}}
    <table>
        <tr>
            <td class="bold">TOTAL</td>
            <td class="right bold">Rp {{ number_format($total,0,',','.') }}</td>
        </tr>
        <tr>
            <td>BAYAR</td>
            <td class="right">Rp {{ number_format($bayar,0,',','.') }}</td>
        </tr>
        <tr>
            <td>KEMBALI</td>
            <td class="right">Rp {{ number_format($kembalian,0,',','.') }}</td>
        </tr>
    </table>

    <div class="line"></div>

    {{-- FOOTER --}}
    <div class="center">
        ** TERIMA KASIH **<br>
        Atas Kunjungan Anda<br><br>

        Barang yang sudah dibeli<br>
        tidak dapat ditukar / dikembalikan<br><br>

        Semoga Hari Anda Menyenangkan :)
    </div>

</div>

</body>
</html>
