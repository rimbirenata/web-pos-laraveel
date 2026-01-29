@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4">Dashboard</h4>

    {{-- INFO CARD --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm stat-card">
                <div class="card-body">
                    Total Barang
                    <h3>{{ $totalBarang }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm stat-card">
                <div class="card-body">
                    Kategori
                    <h3>{{ $totalKategori }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm stat-card">
                <div class="card-body">
                    Pelanggan
                    <h3>{{ $totalPelanggan }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm stat-card">
                <div class="card-body">
                    Transaksi
                    <h3>{{ $totalTransaksi }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- GRAFIK --}}
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tren Penjualan</div>
                <div class="card-body">
                    <canvas id="grafikPenjualan"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- TRANSAKSI TERAKHIR --}}
    <div class="card">
        <div class="card-header bg-primary text-white">
            Transaksi Terakhir
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksiTerakhir as $t)
                    <tr>
                        <td>{{ $t->tanggal_transaksi }}</td>
                        <td>{{ $t->nama_pelanggan }}</td>
                        <td class="text-success">
                            Rp {{ number_format($t->total_bayar,0,',','.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            Belum ada transaksi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('grafikPenjualan'), {
    type: 'line',
    data: {
        labels: @json($bulan),
        datasets: [{
            label: 'Penjualan',
            data: @json($totalPenjualan),
            borderColor: '#0d6efd',
            tension: 0.4,
            fill: false
        }]
    }
});
</script>
@endpush
