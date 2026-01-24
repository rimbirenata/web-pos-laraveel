@extends('layout')

@section('konten')
<div class="card shadow m-2">
    <div class="card-header bg-primary text-white">
        <h5>Data Suplier</h5>
    </div>

    <div class="card-body">

        {{-- PESAN --}}
                @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Suplier</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suplier as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->nama_suplier }}</td>
                    <td>{{ $s->alamat }}</td>
                    <td>{{ $s->no_hp }}</td>
                            <td>
                <a href="{{ url('/suplier/'.$s->id_suplier.'/ubah') }}"
                    class="btn btn-warning btn-sm">
                    Ubah
                </a>

                <form action="{{ route('suplier.hapus', $s->id_suplier) }}"
                    method="POST"
                    style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus suplier ini?')">
                        Hapus
                    </button>
                </form>
            </td>

                </tr>
                @endforeach

                @if($suplier->count() == 0)
                <tr>
                    <td colspan="5" class="text-center">
                        Data suplier kosong
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
