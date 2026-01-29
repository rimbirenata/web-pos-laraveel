<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Penjualan Kabasa')</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            background-color: #f8fafc;
        }

        .sidebar {
            width: 230px;
            background: #f1f5f9;
            border-right: 1px solid #e2e8f0;
            min-height: 100vh;
        }

        .sidebar .nav-link {
            color: #334155;
            border-radius: 12px;
            padding: 10px 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: #0d6efd;
            color: #fff;
        }

        .content {
            flex: 1;
            padding: 24px;
        }

        .card {
            border-radius: 18px;
            border: none;
        }

        .stat-card {
            transition: .25s ease;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(0,0,0,.08);
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-primary px-3">
    <span class="navbar-brand fw-bold">🚀 Penjualan Kabasa</span>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-outline-light btn-sm">Logout</button>
    </form>
</nav>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar p-3">
        <ul class="nav nav-pills flex-column gap-2">
            <li>
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    🏠 Dashboard
                </a>
            </li>
            <li><a href="#" class="nav-link">📦 Data Barang</a></li>
            <li><a href="#" class="nav-link">🚚 Data Supplier</a></li>
            <li><a href="#" class="nav-link">🏷️ Data Kategori</a></li>
            <li><a href="#" class="nav-link">👥 Data Pelanggan</a></li>
            <li><a href="#" class="nav-link">💰 Transaksi</a></li>
            <li><a href="#" class="nav-link">📊 Laporan</a></li>
            <li><a href="#" class="nav-link">👤 Profile</a></li>
        </ul>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</body>
</html>
