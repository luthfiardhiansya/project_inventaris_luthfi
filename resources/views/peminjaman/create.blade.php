@extends('layouts.dashboard')

@section('title','Tambah Peminjaman')

@section('content')
<h4 class="mb-4">Tambah Peminjaman</h4>

<form action="{{ route('peminjaman.store') }}" method="POST">
@csrf

<div class="mb-3">
    <label>Nama Peminjam</label>
    <input type="text" name="nama_peminjam" class="form-control" required>
</div>

<div class="mb-3">
    <label>Jenis Peminjam</label>
    <select name="jenis_peminjam" class="form-select" required>
        <option value="siswa">Siswa</option>
        <option value="guru">Guru</option>
        <option value="umum">Umum</option>
    </select>
</div>

<div class="mb-3">
    <label>Barang</label>
    <select name="barang_id" class="form-select" required>
        @foreach($barang as $b)
            <option value="{{ $b->id }}">
                {{ $b->nama_barang }} (stok: {{ $b->jumlah }})
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Jumlah</label>
    <input type="number" name="jumlah" class="form-control" min="1" required>
</div>

<div class="mb-3">
    <label>Tanggal Pinjam</label>
    <input type="date" name="tanggal_pinjam" class="form-control" required>
</div>

<button class="btn btn-primary">Simpan</button>
<a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>

</form>
@endsection
