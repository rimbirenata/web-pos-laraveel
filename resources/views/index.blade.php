@extends('layout')

@section('konten')

<h5 class="fw-bold mb-4">📊 Dashboard E-Penjualan Kabasa</h5>

{{-- ================= CARD ================= --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm bg-warning text-center">
            <div class="card-body">
                <div class="fw-semibold">Pelanggan</div>
                <h2>{{ $totalPelanggan }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm bg-info text-center">
            <div class="card-body">
                <div class="fw-semibold">Barang</div>
                <h2>{{ $totalBarang }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm bg-success text-center text-white">
            <div class="card-body">
                <div class="fw-semibold">Transaksi</div>
                <h2>{{ $totalTransaksi }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm bg-secondary text-center text-white">
            <div class="card-body">
                <div class="fw-semibold">Kategori</div>
                <h2>{{ $totalKategori }}</h2>
            </div>
        </div>
    </div>
</div>

{{-- ================= GRAFIK ================= --}}
<div class="row g-3 mb-4">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-semibold">
                📈 Penjualan Bulanan
            </div>
            <div class="card-body">
                <canvas id="chartPenjualan"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white fw-semibold">
                📦 Produk Terlaris
            </div>
            <div class="card-body">
                <canvas id="chartProduk"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- ================= TABEL ================= --}}
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white fw-semibold">
        🧾 Transaksi Terakhir
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksiTerakhir as $t)
                <tr>
                    <td>{{ $t->tanggal }}</td>
                    <td>{{ $t->nama_pelanggan }}</td>
                    <td>Rp {{ number_format($t->total) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- ================= SCRIPT CHART ================= --}}
<script>
new Chart(chartPenjualan, {
    type: 'line',
    data: {
        labels: {!! json_encode($bulan) !!},
        datasets: [{
            label: 'Penjualan',
            data: {!! json_encode($totalPenjualan) !!},
            borderWidth: 3,
            tension: 0.4,
            fill: true
        }]
    }
});

new Chart(chartProduk, {
    type: 'bar',
    data: {
        labels: {!! json_encode($produkTerlaris->pluck('nama_barang')) !!},
        datasets: [{
            label: 'Terjual',
            data: {!! json_encode($produkTerlaris->pluck('total')) !!}
        }]
    }
});
</script>

@endsection
