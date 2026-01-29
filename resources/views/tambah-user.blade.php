@extends('layout')

@section('konten')
<div class="card">
    <div class="card-header">
        <h4>Tambah User</h4>
    </div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/user/simpan" method="POST">
            @csrf

            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="/user" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
