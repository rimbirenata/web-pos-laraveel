<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penjualan Kabasa</title>

    <!-- BOOTSTRAP 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body data-bs-theme="light">

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand navbar-dark bg-primary px-3 d-flex justify-content-between">
    <span class="navbar-brand fw-bold">🚀 Penjualan Kabasa</span>

    <div class="d-flex align-items-center gap-2">

        <!-- 📉 NOTIFIKASI STOK MENIPIS -->
        <div class="dropdown">
            <button class="btn btn-outline-warning btn-sm dropdown-toggle"
                    data-bs-toggle="dropdown">
                📉
                <span class="badge bg-danger">
                    {{ $stokMenipis->count() }}
                </span>
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                @forelse ($stokMenipis as $item)
                    <li class="dropdown-item">
                        <strong>{{ $item->nama_barang }}</strong>
                        <div class="small text-muted">
                            Stok tersisa: {{ $item->stok }}
                        </div>
                    </li>
                @empty
                    <li class="dropdown-item text-success">
                        Semua stok aman 👍
                    </li>
                @endforelse
            </ul>
        </div>
        
         <!--MODE-->
        <button id="themeToggle" class="btn btn-outline-light  btn-sm">
            🌙 Dark Mode
        </button>

    </div>
</nav>


<div class="d-flex">

    <!-- =====SIDEBAR===== -->
    <div class="bg-body-secondary p-3 vh-100" style="width:230px">
        <ul class="nav nav-pills flex-column gap-2">

            <li class="nav-item">
                <a href="/dashboard" class="nav-link active">🏠 Dashboard</a>
            </li>

            <li class="nav-item">
                <a href="/barang" class="nav-link">📦 Data Barang</a>
            </li>

            <li class="nav-item">
                <a href="/suplier" class="nav-link">🚚 Data Suplier</a>
            </li>

            <li class="nav-item">
                <a href="/kategori" class="nav-link">🏷️ Data Kategori</a>
            </li>

            <li class="nav-item">
                <a href="/pelanggan" class="nav-link">👥 Data Pelanggan</a>
            </li>

            <li class="nav-item">
                <a href="/transaksi" class="nav-link">💰 Transaksi</a>
            </li>

            <li class="nav-item">
                <a href="/laporan-penjualan" class="nav-link">📊 Laporan Penjualan</a>
            </li>

            <li class="nav-item">
                <a href="/profile" class="nav-link">👤 Profile</a>
            </li>

            <li class="nav-item mt-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger w-100">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>

        </ul>
    </div>
 

 
    <div class="flex-fill p-4 bg-body">
        @yield('konten')
    </div>
  

</div>



<!-- Bootstrap JS (WAJIB untuk dropdown) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Dark / Light Mode (Bootstrap Native) -->
<script>
const btn = document.getElementById('themeToggle');
const body = document.body;

// load theme
const savedTheme = localStorage.getItem('theme') || 'light';
body.setAttribute('data-bs-theme', savedTheme);
btn.innerText = savedTheme === 'dark' ? '☀️ Light Mode' : '🌙 Dark Mode';

// toggle
btn.addEventListener('click', () => {
    const current = body.getAttribute('data-bs-theme');
    const next = current === 'dark' ? 'light' : 'dark';

    body.setAttribute('data-bs-theme', next);
    localStorage.setItem('theme', next);

    btn.innerText = next === 'dark'
        ? '☀️ Light Mode'
        : '🌙 Dark Mode';
});
</script>

</body>
</html>
