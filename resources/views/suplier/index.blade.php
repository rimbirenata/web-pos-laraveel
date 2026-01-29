<!DOCTYPE html>
<html>
<head>
    <title>Data Suplier</title>
</head>
<body>

<h2>Data Suplier</h2>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Aksi</th>
    </tr>

    @foreach ($suplier as $s)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $s->nama }}</td>
        <td>{{ $s->alamat }}</td>
        <td>{{ $s->telepon }}</td>
        <td>
            <a href="{{ route('suplier.hapus', $s->id) }}"
               onclick="return confirm('Yakin mau hapus?')">
               Hapus
            </a>
        </td>
    </tr>
    @endforeach
</table>

</body>
</html>
