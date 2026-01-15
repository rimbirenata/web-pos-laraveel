@extends('layout')
@section('konten')

<h1>Ubah Data Kategori</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="/kategori/ubah/{{ $kategori->id_kategori }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama_kategori">Nama Kategori</label>
        <input type="text" name="nama_kategori" id="nama_kategori"
            class="form-control @error('nama_kategori') is-invalid @enderror"
            value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
        @error('nama_kategori')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-info">Simpan</button>
    <a href="/kategori" class="btn btn-danger">Kembali</a>
</form>

@endsection
