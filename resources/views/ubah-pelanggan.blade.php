@extends('layout')

@section('konten')

<h4>Ubah Pelanggan</h4>

{{-- ALERT ERROR --}}
@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="/pelanggan/ubah/{{ $pelanggan->id }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Pelanggan</label>
        <input type="text"
            name="nama_pelanggan"
            class="form-control @error('nama_pelanggan') is-invalid @enderror"
            value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}">

        @error('nama_pelanggan')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>No HP</label>
        <input type="text"
            name="no_hp"
            class="form-control @error('no_hp') is-invalid @enderror"
            value="{{ old('no_hp', $pelanggan->no_hp) }}">

        @error('no_hp')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea
            name="alamat"
            class="form-control @error('alamat') is-invalid @enderror"
        >{{ old('alamat', $pelanggan->alamat) }}</textarea>

        @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="/pelanggan" class="btn btn-warning">Kembali</a>
</form>

@endsection
