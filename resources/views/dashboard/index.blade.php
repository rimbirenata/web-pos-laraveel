@extends('layout')

@section('konten')

{{-- HEADER --}}
<div class="mb-4">
    <h4 class="fw-bold mb-1">Dashboard</h4>
    <small class="text-muted">Ringkasan penjualan & performa toko</small>
</div>

{{-- STAT CARD --}}
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card bg-primary-subtle border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Total Barang</small>
                    <h2 class="fw-bold mb-0">{{ $totalBarang }}</h2>
                </div>
                <div class="icon-circle bg-primary text-white">
                    <i class="fa-solid fa-box"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card bg-warning-subtle border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Kategori</small>
                    <h2 class="fw-bold mb-0">{{ $totalKategori }}</h2>
                </div>
                <div class="icon-circle bg-warning text-white">
                    <i class="fa-solid fa-tags"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card bg-success-subtle border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Pelanggan</small>
                    <h2 class="fw-bold mb-0">{{ $totalPelanggan }}</h2>
                </div>
                <div class="icon-circle bg-success text-white">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card bg-danger-subtle border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Transaksi</small>
                    <h2 class="fw-bold mb-0">{{ $totalTransaksi }}</h2>
                </div>
                <div class="icon-circle bg-danger text-white">
                    <i class="fa-solid fa-receipt"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- GRAFIK --}}
<div class="row g-4 mb-4">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-transparent fw-semibold">
                📈 Tren Penjualan Tahunan
            </div>
            <div class="card-body">
                <div style="height:350px">
                    <canvas id="areaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-transparent fw-semibold">
                📊 Perbandingan Bulanan
            </div>
            <div class="card-body">
                <div style="height:260px">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- INSIGHT --}}
<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-2">💡 Insight Penjualan</h6>
                <p class="text-muted mb-0">
                    Penjualan tertinggi terjadi pada awal tahun.
                    Setelah bulan Januari, transaksi cenderung stabil dengan volume rendah.
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body">
                <h6 class="fw-bold mb-2">🚀 Rekomendasi</h6>
                <p class="mb-0">
                    Tingkatkan promo pada bulan sepi untuk menjaga konsistensi penjualan.
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = @json($bulan);
const dataPenjualan = @json($totalPenjualan);

// AREA CHART
new Chart(document.getElementById('areaChart'), {
    type: 'line',
    data: {
        labels,
        datasets: [{
            data: dataPenjualan,
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13,110,253,.25)',
            fill: true,
            tension: 0.4,
            pointRadius: 5,
            pointHoverRadius: 7
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            x: {
                grid: { display: false },
                ticks: { font: { size: 13 } }
            },
            y: {
                beginAtZero: true,
                ticks: { font: { size: 13 } }
            }
        }
    }
});

// BAR CHART
new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels,
        datasets: [{
            data: dataPenjualan,
            backgroundColor: '#0d6efd',
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { font: { size: 13 } }
            }
        }
    }
});
</script>

@endsection
