<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: 
                linear-gradient(rgba(88, 63, 185, 0.6), rgba(88, 63, 185, 0.6)),
                url('/images/penjualan.jpg');
            background-size: cover;
            background-position: center;
        }

        .login-card {
            width: 340px;
            background: #fff;
            padding: 30px 25px;
            border-radius: 14px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.25);
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #5b3cc4;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #5b3cc4;
            box-shadow: 0 0 0 2px rgba(91,60,196,0.15);
        }

        .btn-login {
            width: 100%;
            padding: 10px;
            background: #5b3cc4;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #4a2fb0;
        }

        .login-footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>LOGIN</h2>

    <form method="POST" action="/login">
        @csrf
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button class="btn-login">Login</button>
    </form>

    <div class="login-footer">
        Sistem Penjualan • Kasir Toko
    </div>
</div>

</body>
</html>
