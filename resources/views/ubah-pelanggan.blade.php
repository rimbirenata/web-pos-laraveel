@extends('layout')

@section('konten')
<div class="card m-3">
    <div class="card-header">
        <h4>Ubah Pelanggan</h4>
    </div>

    <div class="card-body">
        <form action="/pelanggan/{{ $pelanggan->id_pelanggan }}/ubah" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama_pelanggan"
                       value="{{ $pelanggan->nama_pelanggan }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp"
                       value="{{ $pelanggan->no_hp }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control">{{ $pelanggan->alamat }}</textarea>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="/pelanggan" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
