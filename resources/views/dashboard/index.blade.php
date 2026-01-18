@extends('layout')

@section('konten')

<style>
.card-stat {
    transition: .3s;
    border-radius: 14px;
}
.card-stat:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,.15);
}
.section-title {
    font-weight: bold;
    font-size: 1.1rem;
}
.rank {
    width: 32px;
    height: 32px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    font-weight: bold;
}
.rank-1 { background: gold; }
.rank-2 { background: silver; }
.rank-3 { background: #cd7f32; }
</style>

<h4 class="fw-bold mb-4">📊 Dashboard E-Penjualan Kabasa</h4>

{{-- ================= STATISTIK ================= --}}

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-stat text-center bg-warning">
            <div class="card-body">
                <h3>{{ $totalPelanggan }}</h3>
                <small>Pelanggan</small>
            </div>
        </div>
    </div>

```
<div class="col-md-3">
    <div class="card card-stat text-center bg-info">
        <div class="card-body">
            <h3>{{ $totalBarang }}</h3>
            <small>Barang</small>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card card-stat text-center bg-secondary text-white">
        <div class="card-body">
            <h3>{{ $totalTransaksi }}</h3>
            <small>Transaksi</small>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card card-stat text-center bg-success text-white">
        <div class="card-body">
            <h3>{{ $totalKategori }}</h3>
            <small>Kategori</small>
        </div>
    </div>
</div>
```

</div>

{{-- ================= GRAFIK ================= --}}

<div class="card mb-4">
    <div class="card-header section-title">
        📈 Grafik Penjualan Bulanan
    </div>
    <div class="card-body">
        <canvas id="grafikPenjualan" height="100"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('grafikPenjualan');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($bulan),
        datasets: [{
            label: 'Total Penjualan',
            data: @json($totalPenjualan),
            backgroundColor: '#0d6efd',
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        }
    }
});
</script>

<div class="row g-4">

{{-- ================= PRODUK TERLARIS ================= --}}

<div class="col-md-6">
    <div class="card">
        <div class="card-header section-title">🔥 Produk Terlaris</div>

```
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Total Terjual</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produkTerlaris as $index => $p)
                <tr>
                    <td>
                        <span class="rank rank-{{ $index+1 }}">
                            {{ $index+1 }}
                        </span>
                    </td>
                    <td>{{ $p->nama_barang }}</td>
                    <td class="fw-bold text-primary">
                        {{ $p->total_terjual }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted py-3">
                        Belum ada data penjualan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
```

</div>

{{-- ================= TRANSAKSI TERAKHIR ================= --}}

<div class="col-md-6">
    <div class="card">
        <div class="card-header section-title">🧾 Transaksi Terakhir</div>

```
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
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
```

</div>

</div>

@endsection
