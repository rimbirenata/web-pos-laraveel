@extends('layout')

@section('konten')
<h3>Tambah Pelanggan</h3>

{{-- TAMPILKAN PESAN ERROR --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/pelanggan/simpan" method="POST">
    @csrf

    <div class="mb-3">
        <label>ID</label>
        <input 
            type="text" 
            name="id_pelanggan" 
            class="form-control @error('id_pelanggan') is-invalid @enderror"
            value="{{ old('id_pelanggan') }}"
        >
    </div>

    <div class="mb-3">
        <label>Nama</label>
        <input 
            type="text" 
            name="nama_pelanggan" 
            class="form-control @error('nama_pelanggan') is-invalid @enderror"
            value="{{ old('nama_pelanggan') }}"
        >
    </div>

    <div class="mb-3">
        <label>No HP</label>
        <input 
            type="text" 
            name="no_hp" 
            class="form-control @error('no_hp') is-invalid @enderror"
            value="{{ old('no_hp') }}"
        >
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea 
            name="alamat" 
            class="form-control @error('alamat') is-invalid @enderror"
        >{{ old('alamat') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="/pelanggan" class="btn btn-secondary">Kembali</a>
</form>
@endsection
