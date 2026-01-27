<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            min-height:100vh;
            background: linear-gradient(135deg, #1349eb, #1cc88a);
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .login-card{
            width:380px;
            border-radius:15px;
        }
    </style>
</head>
<body>

<div class="card login-card shadow-lg">
    <div class="card-header text-center bg-primary text-white rounded-top">
        <h4 class="mb-0">🔐 Login</h4>
        <small>Silakan masuk untuk melanjutkan</small>
    </div>
    <div class="card-body p-4">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">🚀 Login</button>
        </form>
    </div>
    <div class="card-footer text-center text-muted">
        <small>© {{ date('Y') }} Aplikasi</small>
    </div>
</div>

</body>
</html>
