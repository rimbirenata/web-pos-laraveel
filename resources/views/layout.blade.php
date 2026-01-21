<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penjualan Kabasa</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body data-bs-theme="light">

<nav class="navbar navbar-dark bg-primary px-3 d-flex justify-content-between">
    <span class="navbar-brand fw-bold">🚀 Penjualan Kabasa</span>

    <div class="d-flex align-items-center gap-2">
        <!-- NOTIF STOK -->
        <div class="dropdown">
            <button class="btn btn-outline-warning btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                📉 <span class="badge bg-danger">{{ $stokMenipis->count() }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                @forelse($stokMenipis as $item)
                    <li class="dropdown-item">
                        <strong>{{ $item->nama_barang }}</strong><br>
                        <small>Stok: {{ $item->stok }}</small>
                    </li>
                @empty
                    <li class="dropdown-item text-success">Stok aman 👍</li>
                @endforelse
            </ul>
        </div>

        <!-- MODE -->
        <button id="themeToggle" class="btn btn-outline-light btn-sm">🌙 Dark Mode</button>
    </div>
</nav>

<div class="d-flex">
    <!-- SIDEBAR -->
    <div class="bg-body-secondary p-3 vh-100" style="width:230px">
        <ul class="nav nav-pills flex-column gap-2">
            <li><a href="/dashboard" class="nav-link active">🏠 Dashboard</a></li>
            <li><a href="/barang" class="nav-link">📦 Data Barang</a></li>
            <li><a href="/suplier" class="nav-link">🚚 Data Suplier</a></li>
            <li><a href="/kategori" class="nav-link">🏷️ Data Kategori</a></li>
            <li><a href="/pelanggan" class="nav-link">👥 Data Pelanggan</a></li>
            <li><a href="/transaksi" class="nav-link">💰 Transaksi</a></li>
            <li><a href="/laporan-penjualan" class="nav-link">📊 Laporan</a></li>
            <li><a href="/profile" class="nav-link">👤 Profile</a></li>
            <li class="mt-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>

            </li>
        </ul>
    </div>

    <!-- CONTENT -->
    <div class="flex-fill p-4">
        @yield('konten')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DARK MODE -->
<script>
const btn = document.getElementById('themeToggle');
const body = document.body;
const theme = localStorage.getItem('theme') || 'light';
body.setAttribute('data-bs-theme', theme);
btn.innerText = theme === 'dark' ? '☀️ Light Mode' : '🌙 Dark Mode';

btn.onclick = () => {
    const t = body.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
    body.setAttribute('data-bs-theme', t);
    localStorage.setItem('theme', t);
    btn.innerText = t === 'dark' ? '☀️ Light Mode' : '🌙 Dark Mode';
};
</script>

</body>
</html>
