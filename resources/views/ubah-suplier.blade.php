@extends('layout')

@section('konten')
<div class="card shadow m-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Ubah Suplier</h5>
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

        <form action="{{ route('suplier.update', $suplier->id_suplier) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">ID Suplier</label>
                <input type="text"
                       class="form-control"
                       value="{{ $suplier->id_suplier }}"
                       readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Suplier</label>
                <input type="text"
                       name="nama_suplier"
                       class="form-control"
                       value="{{ old('nama_suplier', $suplier->nama_suplier) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text"
                       name="no_hp"
                       class="form-control"
                       value="{{ old('no_hp', $suplier->no_hp) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat"
                          class="form-control"
                          rows="3"
                          required>{{ old('alamat', $suplier->alamat) }}</textarea>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('suplier.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>
@endsection
