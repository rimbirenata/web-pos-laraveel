<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }
        .card {
            background: #fff;
            padding: 30px;
            width: 320px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 5px;
        }
        p {
            color: #777;
            font-size: 14px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #1e73ff;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #155ed8;
        }
        .error {
            color: red;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Login</h2>
    <p>Silakan masuk ke sistem</p>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login.proses') }}">
        @csrf
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
