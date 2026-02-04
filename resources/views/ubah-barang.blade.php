@extends('layout')

@section('konten')
<div class="card shadow m-3">
    <div class="card-header bg-warning text-dark">
        ✏️ Ubah Barang
    </div>

    <div class="card-body">

        {{-- ERROR VALIDASI BACKEND (KODE ASLI) --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('barang-update', $barang->id_barang) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- NAMA BARANG (KODE ASLI + TAMBAHAN) --}}
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text"
                       name="nama_barang"
                       id="nama_barang"
                       class="form-control"
                       value="{{ $barang->nama_barang }}"
                       required>

                {{-- PESAN PERINGATAN --}}
                <small id="peringatan-nama"
                       class="text-danger"
                       style="display:none;">
                    Tidak boleh angka dan tanda titik koma seru tanya dan slash
                </small>
            </div>

            {{-- KATEGORI --}}
            <div class="mb-3">
                <label>Kategori</label>
                <select name="id_kategori" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id_kategori }}"
                            {{ $barang->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- SUPLIER --}}
            <div class="mb-3">
                <label>Suplier</label>
                <select name="id_suplier" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($suplier as $s)
                        <option value="{{ $s->id_suplier }}"
                            {{ $barang->id_suplier == $s->id_suplier ? 'selected' : '' }}>
                            {{ $s->nama_suplier }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- STOK --}}
            <div class="mb-3">
                <label>Stok</label>
                <input type="number"
                       name="stok"
                       class="form-control"
                       value="{{ $barang->stok }}"
                       required>
            </div>

            {{-- HARGA BELI --}}
            <div class="mb-3">
                <label>Harga Beli</label>
                <input type="number"
                       name="harga_beli"
                       class="form-control"
                       value="{{ $barang->harga_beli }}"
                       required>
            </div>

            {{-- HARGA JUAL --}}
            <div class="mb-3">
                <label>Harga Jual</label>
                <input type="number"
                       name="harga_jual"
                       class="form-control"
                       value="{{ $barang->harga_jual }}"
                       required>
            </div>

            <button class="btn btn-warning" id="btn-submit">Update</button>
            <a href="{{ route('barang') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

{{-- JAVASCRIPT VALIDASI (TAMBAHAN) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const namaBarang = document.getElementById('nama_barang');
    const peringatan = document.getElementById('peringatan-nama');
    const tombol = document.getElementById('btn-submit');

    // karakter terlarang: angka . , ! ? /
    const regexTerlarang = /[0-9\.\,\!\?\/]/;

    namaBarang.addEventListener('input', function () {
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
