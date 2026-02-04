<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: monospace;
        background: #eee;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .struk {
        width: 280px;
        background: #fff;
        padding: 12px;
        border: 1px dashed #000;
        font-size: 13px;
        line-height: 1.3;
    }

    .center {
        text-align: center;
    }

    .center strong {
        font-size: 16px;
        letter-spacing: 1px;
    }

    .line {
        border-top: 1px dashed #000;
        margin: 6px 0;
    }

    .struk span {
        float: right;
    }

    .btn-print {
        margin-top: 15px;
        padding: 8px 18px;
        font-size: 14px;
        cursor: pointer;
    }

    @media print {
        body {
            background: none;
        }

        .btn-print {
            display: none;
        }

        .struk {
            border: none;
            width: 260px;
            font-size: 12px;
        }
    }
</style>

    </style>
</head>
<body>
<div class="container">
    <div class="struk">
        <div class="center">
            <strong>TOKO KABASA SERBA ADA</strong><br>
            jalanin aja dulu siapa tau nyaman<br>
            kecamatan selalu di kecewakan
            Telp: 0812-XXXX-XXXX
        </div>

        <div class="line"></div>

        No Transaksi: {{ $transaksi->id_transaksi }}<br>
        Tanggal: {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y H:i') }}

        <div class="line"></div>

        @foreach ($detail as $item)
            {{ $item->nama_barang }}<br>
            {{ $item->jumlah }} x {{ number_format($item->harga_jual) }}
            <span style="float:right">{{ number_format($item->jumlah * $item->harga_jual) }}</span>
            <br>
        @endforeach

        <div class="line"></div>

        Total <span style="float:right">{{ number_format($transaksi->total_bayar) }}</span><br>
        Bayar <span style="float:right">{{ number_format($uangDibayar) }}</span><br>
        Kembali <span style="float:right">{{ number_format($kembalian) }}</span>

        <div class="line"></div>

        <div class="center">
            Terima kasih sudah berbelanja 🙏
        </div>
    </div>

    <button class="btn-print" onclick="window.print()">🖨 Print Struk</button>
</div>
</body>
</html>
