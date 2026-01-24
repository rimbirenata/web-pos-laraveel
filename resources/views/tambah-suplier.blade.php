@extends('layout')

@section('konten')
<div class="card shadow m-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Tambah Suplier</h5>
    </div>

    <div class="card-body">

        {{-- ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('suplier.simpan') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Suplier</label>
                <input type="text"
                       name="nama_suplier"
                       class="form-control"
                       value="{{ old('nama_suplier') }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text"
                       name="no_hp"
                       class="form-control"
                       value="{{ old('no_hp') }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat"
                          class="form-control"
                          rows="3"
                          required>{{ old('alamat') }}</textarea>
            </div>

            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('suplier.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>
@endsection
