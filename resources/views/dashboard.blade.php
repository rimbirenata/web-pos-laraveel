@extends('layout')

@section('konten')
<h1>Dashboard</h1>
<p>Halo, {{ session('nama') }}</p>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
@endsection
