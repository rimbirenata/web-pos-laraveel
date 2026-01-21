    <!DOCTYPE html>
    <html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>

    <h1>Dashboard</h1>

    <p>Halo, {{ session('nama') }}</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    </body>
    </html>
 