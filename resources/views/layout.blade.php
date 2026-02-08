<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penjualan Kabasa</title>

    <!-- BOOTSTRAP & ICON -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0d6efd;
        }

        body {
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            background: #f8fafc;
        }

        /* NAVBAR */
        .navbar {
            box-shadow: 0 2px 12px rgba(0,0,0,.08);
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #f1f5f9;
            border-right: 1px solid #e2e8f0;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar .nav-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: 14px;
            color: #334155;
            font-weight: 500;
            transition: all .25s ease;
        }

        .sidebar .icon {
            font-size: 20px;
            width: 26px;
            text-align: center;
        }

        /* HOVER */
        .sidebar .nav-link:hover {
            background: rgba(13,110,253,.12);
            color: var(--primary);
            transform: translateX(6px);
        }

        /* ACTIVE */
        .sidebar .nav-link.active {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 6px 18px rgba(13,110,253,.4);
        }

        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            left: -6px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 70%;
            background: var(--primary);
            border-radius: 4px;
        }

        /* CONTENT */
        .content {
            background: #f8fafc;
        }

        /* CARD */
        .card {
            border-radius: 18px;
            border: none;
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
            color: #fff;
        }

        [data-bs-theme="dark"] .card {
            background: #020617;
            color: #e5e7eb;
        }
    </style>
</head>

<body data-bs-theme="light">

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-primary px-4 d-flex justify-content-between">
    <span class="navbar-brand fw-bold">🚀 Penjualan Kabasa</span>

    <button id="themeToggle" class="btn btn-outline-light btn-sm">
        🌙 Dark Mode
    </button>
</nav>

<div class="d-flex">
    <!-- SIDEBAR -->
    <aside class="sidebar p-3 vh-100">
        <ul class="sidebar-menu">

            <li>
                <a href="/dashboard" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                    <span class="icon">🏠</span>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="/barang" class="nav-link {{ request()->is('barang*') ? 'active' : '' }}">
                    <span class="icon">📦</span>
                    <span>Data Barang</span>
                </a>
            </li>

            <li>
                <a href="/suplier" class="nav-link {{ request()->is('suplier*') ? 'active' : '' }}">
                    <span class="icon">🚚</span>
                    <span>Data Suplier</span>
                </a>
            </li>

            <li>
                <a href="/kategori" class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}">
                    <span class="icon">🏷️</span>
                    <span>Data Kategori</span>
                </a>
            </li>

            <li>
                <a href="/pelanggan" class="nav-link {{ request()->is('pelanggan*') ? 'active' : '' }}">
                    <span class="icon">👥</span>
                    <span>Data Pelanggan</span>
                </a>
            </li>

            <li>
                <a href="/transaksi" class="nav-link {{ request()->is('transaksi*') ? 'active' : '' }}">
                    <span class="icon">💰</span>
                    <span>Transaksi</span>
                </a>
            </li>

            <li>
                <a href="laporan" class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}">
                    <span class="icon">📊</span>
                    <span>Laporan</span>
                </a>
            </li>

            <li>
                <a href="/profile" class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">
                    <span class="icon">👤</span>
                    <span>Profile</span>
                </a>
            </li>

            <li class="mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger w-100 rounded-pill">
                        🚪 Logout
                    </button>
                </form>
            </li>

        </ul>
    </aside>

    <!-- CONTENT -->
    <main class="flex-fill p-4 content">
        @yield('konten')
    </main>
</div>

<!-- SCRIPT -->
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
