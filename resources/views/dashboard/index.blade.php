@extends('layout')

@section('konten')
<div class="container-fluid">

    {{-- INFO CARD --}}
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white mb-3">
                <div class="card-body">Total Barang<br><h4>{{ $totalBarang }}</h4></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white mb-3">
                <div class="card-body">Kategori<br><h4>{{ $totalKategori }}</h4></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">Pelanggan<br><h4>{{ $totalPelanggan }}</h4></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white mb-3">
                <div class="card-body">Transaksi<br><h4>{{ $totalTransaksi }}</h4></div>
            </div>
        </div>
    </div>

    {{-- GRAFIK --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">Area Chart</div>
                <div class="card-body">
                    <canvas id="areaChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">Bar Chart</div>
                <div class="card-body">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- PRODUK TERLARIS --}}
    <div class="card shadow mb-4">
        <div class="card-header btn btn-primary">Produk Terlaris</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Total Terjual</th>
                </tr>
                <tbody>
                @forelse($transaksiTerakhir as $t)
                <tr>
                <td>
                {{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d-m-Y') }}
                </td>
                <td>{{ $t->nama_pelanggan }}</td>
                <td class="fw-bold text-success">
                Rp {{ number_format($t->total_bayar,0,',','.') }}
                </td>
                </tr>
                @empty
<tr>
    <td colspan="3" class="text-center text-muted py-3">
        Belum ada transaksi
    </td>
</tr>
@endforelse
</tbody>


            </table>
        </div>
    </div>

    {{-- TRANSAKSI TERAKHIR --}}
    <div class="card shadow mb-4">
        <div class="card-header btn btn-primary">Transaksi Terakhir</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                </tr>
                @forelse($transaksiTerakhir as $t)
                <tr>
                    <td>{{ $t->tanggal_transaksi }}</td>
                    <td>{{ $t->nama_pelanggan }}</td>
                    <td>{{ number_format($t->total_bayar) }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center">Belum ada transaksi</td></tr>
                @endforelse
            </table>
        </div>
    </div>

</div>

{{-- CHART JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const labels = @json($bulan);
const dataPenjualan = @json($totalPenjualan);

// AREA CHART
new Chart(document.getElementById('areaChart'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Penjualan',
            data: dataPenjualan,
            fill: true,
            tension: 0.4,
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});

// BAR CHART
new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Penjualan',
            data: dataPenjualan
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
@endsection
