<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
        * { box-sizing: border-box; }
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
            width: 350px;          /* Lebar lebih besar */
            background: #fff;
            padding: 20px;         /* Padding lebih lega */
            border: 1px dashed #000;
            font-size: 16px;       /* Font lebih besar */
            line-height: 1.4;      /* Lebih rapih */
        }

        .center { text-align: center; }
        .line { border-top: 1px dashed #000; margin: 10px 0; }
        .btn-print { 
            margin-top: 20px; 
            padding: 10px 25px; 
            font-size: 16px;
            cursor: pointer;
        }

        @media print {
            .btn-print { display: none; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="struk">
        <div class="center">
            <strong>INDOMARET</strong><br>
            Jl. Contoh Alamat No.123<br>
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

        <strong>Total</strong> <span style="float:right">{{ number_format($transaksi->total_bayar) }}</span><br>
        <strong>Bayar</strong> <span style="float:right">{{ number_format($uangDibayar) }}</span><br>
        <strong>Kembali</strong> <span style="float:right">{{ number_format($kembalian) }}</span>

        <div class="line"></div>

        <div class="center">
            Terima kasih sudah berbelanja 🙏<br>
            Barang yang sudah dibeli tidak dapat dikembalikan
        </div>
    </div>

    <button class="btn-print" onclick="window.print()">🖨 Print Struk</button>
</div>
</body>
</html>
