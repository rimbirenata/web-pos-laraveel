<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="card p-4" style="width:360px;">
    <h4 class="text-center mb-3">Login</h4>

    <form action="/login" method="POST">
        @csrf
        <input class="form-control mb-2" name="username" placeholder="Username">
        <input class="form-control mb-3" type="password" name="password" placeholder="Password">
        <button class="btn btn-primary w-100">Login</button>
    </form>
    
    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif
</div>

</body>
</html>
