<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form action="/login" method="POST">
    @csrf

    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>
