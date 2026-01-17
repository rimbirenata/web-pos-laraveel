<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Penjualan Kabasa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="card border-0 shadow-sm" style="width: 400px;">
    <div class="card-body p-4">

        <!-- Judul -->
        <div class="text-center mb-4">
            <h5 class="fw-bold mb-0">Penjualan Kabasa</h5>
            <small class="text-muted">Sistem Informasi Penjualan</small>
        </div>

        <!-- Pesan instruksi -->
        <p class="text-center text-muted mb-3">
            Silakan login untuk melanjutkan
        </p>

        <!-- Form -->
        <form action="/login" method="POST">
            @csrf

            <div class="form-floating mb-3">
                <input 
                    type="text" 
                    name="username" 
                    class="form-control" 
                    id="username" 
                    placeholder="Username" 
                    required
                >
                <label for="username">Username</label>
            </div>

            <div class="form-floating mb-3">
                <input 
                    type="password" 
                    name="password" 
                    class="form-control" 
                    id="password" 
                    placeholder="Password" 
                    required
                >
                <label for="password">Password</label>
            </div>

            <button class="btn btn-success w-100">
                Login
            </button>
        </form>

        <!-- Error -->
        @if(session('error'))
            <div class="alert alert-danger mt-3 text-center">
                {{ session('error') }}
            </div>
        @endif

           @if(session('error'))
            <div class="alert alert-danger mt-3 text-center">
                {{ session('error') }}
            </div>
        @endif


    </div>
</div>

</body>
</html>
