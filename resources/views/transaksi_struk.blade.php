<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body onload="window.print()">

<div class="container d-flex justify-content-center">
    <div class="col-12 col-sm-8 col-md-4 small">

        <div class="text-center mb-2">
            <strong>TOKO KABASA LOVERS</strong><br>
            Jl jalanin aja dulu siapa tau nyaman<br>
            Telp: 08123456789
        </div>

        <hr>

        <table class="table table-borderless table-sm">
            <tr>
                <td>Tanggal</td>
                <td class="text-end">{{ now()->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td class="text-end">{{ $kasir }}</td>
            </tr>
        </table>

        <hr>

        <table class="table table-borderless table-sm">
            @foreach ($detail as $d)
                <tr>
                    <td colspan="2">{{ optional($d->barang)->nama_barang ?? '-' }}</td>
                </tr>
                <tr>
                    <td>{{ $d->jumlah }} x {{ number_format($d->harga_saat_beli) }}</td>
                    <td class="text-end">{{ number_format($d->subtotal) }}</td>
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
            Barang yang sudah dibeli tidak dapat dikembalikan
        </div>

    </div>
</div>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
