@extends('layout')

@section('konten')
<div class="card m-2">
    <div class="card-header">
        <h3>Form Ubah Pelanggan</h3>
    </div>

    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/pelanggan/ubah/{{ $pelanggan->id_pelanggan }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>ID Pelanggan</label>
                <input type="text" class="form-control" value="{{ $pelanggan->id_pelanggan }}" readonly>
            </div>

            <div class="mb-3">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan"
                    class="form-control"
                    value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}">
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp"
                    class="form-control"
                    value="{{ old('no_hp', $pelanggan->no_hp) }}">
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control">{{ old('alamat', $pelanggan->alamat) }}</textarea>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="/pelanggan" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</div>
@endsection
