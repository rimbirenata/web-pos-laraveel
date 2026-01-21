    <!DOCTYPE html>
    <html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>

    @extends('layout')

    @section('konten')
    <h1>Dashboard</h1>
    <p>Halo, {{ session('nama') }}</p>
    @endsection

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    </body>
    </html>
 