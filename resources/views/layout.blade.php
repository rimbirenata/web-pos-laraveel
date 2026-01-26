<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penjualan Kabasa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
      @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

:root {
    --primary: #0d6efd;
}

body {
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    background-color: #f8fafc;
}

/* NAVBAR */
.navbar {
    box-shadow: 0 2px 12px rgba(0,0,0,.08);
}

/* SIDEBAR */
.sidebar {
    width: 230px;
    background: #f1f5f9;
    border-right: 1px solid #e2e8f0;
}

.sidebar .nav-link {
    color: #334155;
    border-radius: 12px;
    padding: 10px 14px;
    font-weight: 500;
    transition: .2s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sidebar .nav-link:hover {
    background: rgba(13,110,253,.1);
    color: var(--primary);
}

.sidebar .nav-link.active {
    background: var(--primary);
    color: #fff;
    box-shadow: 0 4px 12px rgba(13,110,253,.35);
}

/* CARD */
.card {
    border-radius: 18px;
    border: none;
}

/* STAT CARD */
.stat-card {
    border-radius: 20px;
    transition: .25s ease;
}
.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0,0,0,.08);
}

/* BUTTON */
.btn {
    border-radius: 12px;
}

/* TABLE */
.table th {
    font-weight: 600;
    color: #475569;
}

/* DARK MODE */
[data-bs-theme="dark"] body {
    background: #0f172a;
}

[data-bs-theme="dark"] .sidebar {
    background: #020617;
    border-color: #020617;
}

[data-bs-theme="dark"] .sidebar .nav-link {
    color: #cbd5f5;
}

[data-bs-theme="dark"] .sidebar .nav-link:hover {
    background: rgba(255,255,255,.08);
}

[data-bs-theme="dark"] .sidebar .nav-link.active {
    background: var(--primary);
}

[data-bs-theme="dark"] .card {
    background: #020617;
    color: #e5e7eb;
}
    </style>
</head>

<body data-bs-theme="light">

<!-- NAVBAR -->
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

        <button id="themeToggle" class="btn btn-outline-light btn-sm">
            🌙 Dark Mode
        </button>
    </div>
</nav>

<div class="d-flex">
    <!-- SIDEBAR -->
    <div class="sidebar bg-body-secondary p-3 vh-100">
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
                    <button class="btn btn-danger w-100">Logout</button>
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
