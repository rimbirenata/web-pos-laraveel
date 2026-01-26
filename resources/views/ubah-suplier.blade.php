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

            {{-- NAMA SUPLIER --}}
            <div class="mb-3">
                <label class="form-label">Nama Suplier</label>
                <input type="text"
                       name="nama_suplier"
                       id="nama_suplier"
                       class="form-control"
                       value="{{ old('nama_suplier') }}"
                       required>

                {{-- PESAN PERINGATAN --}}
                <small id="peringatan-suplier"
                       class="text-danger"
                       style="display:none;">
                    Nama suplier tidak boleh angka dan tanda titik koma seru tanya dan slash
                </small>
            </div>

            {{-- NO HP --}}
            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text"
                       name="no_hp"
                       class="form-control"
                       value="{{ old('no_hp') }}"
                       required>
            </div>

            {{-- ALAMAT --}}
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat"
                          class="form-control"
                          rows="3"
                          required>{{ old('alamat') }}</textarea>
            </div>

            <button class="btn btn-success" id="btn-simpan">Simpan</button>
            <a href="{{ route('suplier.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

{{-- JAVASCRIPT VALIDASI (TAMBAHAN) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const namaSuplier = document.getElementById('nama_suplier');
    const peringatan  = document.getElementById('peringatan-suplier');
    const tombol     = document.getElementById('btn-simpan');

    // karakter terlarang: angka . , ! ? /
    const regexTerlarang = /[0-9\.\,\!\?\/]/;

    namaSuplier.addEventListener('input', function () {
        if (regexTerlarang.test(this.value)) {
            peringatan.style.display = 'block';
            tombol.disabled = true;
        } else {
            peringatan.style.display = 'none';
            tombol.disabled = false;
        }
    });
});
</script>
@endsection
