@extends('layout')

@section('konten')
<h1>Dashboard</h1>


<form action="{{ route('logout') }}" method="POST">
    @csrf
 
</form>
@endsection
