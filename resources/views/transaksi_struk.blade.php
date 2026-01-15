<!DOCTYPE html>
<html lang="en">
<head>
    <title>Struk Transaksi</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body onload="window.print()" class="bg-info">

<div class="container d-flex justify-content-center">
    <div class="col-12 col-sm-8 col-md-4 small">

        
        <div class="text-center mb-2">
            <strong>TOKO KABASA</strong><br>
            Jl Hasyim Asy'ary Banjarejo Pagelaran Malang<br>
            Telp: 08123456789
        </div>

        <hr class="border border-dark border-1 border-dashed">

        
        <table class="table table-borderless table-sm mb-1">
            <tr>
                <td>Tanggal</td>
                <td class="text-end">{{ date('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td class="text-end">{{ auth()->user()->name ?? 'Admin' }}</td>
            </tr>
        </table>

        <hr>

   
        <table class="table table-borderless table-sm">
            @foreach($detail as $d)
            <tr>
                <td colspan="2">{{ $d['nama'] }}</td>
            </tr>
            <tr>
                <td>{{ $d['jumlah'] }} x {{ number_format($d['harga']) }}</td>
                <td class="text-end">{{ number_format($d['subtotal']) }}</td>
            </tr>
            @endforeach
        </table>

        <hr>

        <table class="table table-borderless table-sm">
            <tr class="fw-bold">
                <td>TOTAL</td>
                <td class="text-end">{{ number_format($total) }}</td>
            </tr>
            <tr>
                <td>BAYAR</td>
                <td class="text-end">{{ number_format($bayar) }}</td>
            </tr>
            <tr>
                <td>KEMBALI</td>
                <td class="text-end">{{ number_format($kembalian) }}</td>
            </tr>
        </table>

        <hr>

       
        <div class="text-center mt-2">
            <strong>*** TERIMA KASIH ***</strong><br>
            Barang yang sudah dibeli<br>
            tidak dapat dikembalikan
        </div>

    </div>
</div>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
