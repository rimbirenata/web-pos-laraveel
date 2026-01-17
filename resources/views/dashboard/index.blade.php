@extends('layout')

@section('konten')

<h4 class="fw-bold mb-4">📊 E - PENJUALAN KABASA</h4>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-center bg-warning">
            <div class="card-body">
                <h3>{{ $totalPelanggan }}</h3>
                <small>Pelanggan</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center bg-info">
            <div class="card-body">
                <h3>{{ $totalBarang }}</h3>
                <small>Barang</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center bg-secondary text-white">
            <div class="card-body">
                <h3>{{ $totalTransaksi }}</h3>
                <small>Transaksi</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center bg-success text-white">
            <div class="card-body">
                <h3>{{ $totalKategori }}</h3>
                <small>Kategori</small>
            </div>
        </div>
    </div>
</div>

<!-- 📈 GRAFIK -->
<div class="card mb-4">
    <div class="card-header fw-bold">📈 Grafik Penjualan Bulanan</div>
    <div class="card-body">
        <canvas id="grafikPenjualan"></canvas>
    </div>
</div>

<script>
const ctx = document.getElementById('grafikPenjualan');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($bulan),
        datasets: [{
            label: 'Total Penjualan',
            data: @json($totalPenjualan),
            backgroundColor: 'rgba(54, 162, 235, 0.7)'
        }]
    }
});
</script>

<h5>🔥 Produk Terlaris</h5>
<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <th>Total Terjual</th>
    </tr>
    @foreach($produkTerlaris as $p)
    <tr>
        <td>{{ $p->nama_barang }}</td>
        <td>{{ $p->total_terjual }}</td>
    </tr>
    @endforeach
</table>

<h5>🧾 Transaksi Terakhir</h5>
<table class="table table-bordered">
    <tr>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Total</th>
    </tr>
    @foreach($transaksiTerakhir as $t)
    <tr>
        <td>{{ $t->tanggal_transaksi }}</td>
        <td>{{ $t->nama_pelanggan }}</td>
        <td>Rp {{ number_format($t->total_bayar) }}</td>
    </tr>
    @endforeach
</table>

@endsection
