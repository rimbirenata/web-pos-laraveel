@extends('layout')

@section('konten')
<div class="card m-2">
    <div class="card-header">
        <h3>Form Tambah Data Suplier</h3>
    </div>

    <div class="card-body">
        <form action="/suplier/simpan" method="POST">
            @csrf

            <div class="row mb-3">
                <label class="col-3 col-form-label">NAMA SUPLIER</label>
                <div class="col-9">
                    <input type="text" name="nama_suplier" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-3 col-form-label">NO HP</label>
                <div class="col-9">
                    <input type="text" name="no_hp" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-3 col-form-label">ALAMAT</label>
                <div class="col-9">
                    <input type="text" name="alamat" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-3"></div>
                <div class="col-9">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/suplier" class="btn btn-warning">Kembali</a>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
