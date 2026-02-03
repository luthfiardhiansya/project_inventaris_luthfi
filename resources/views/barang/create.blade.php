@extends('layouts.dashboard')

@section('title', 'Tambah Barang')

@section('content')
<h2 class="h3 mb-4">Tambah Barang</h2>

<div class="card shadow-sm border-0">
    <div class="card-body">
<form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
@csrf
{{-- NAMA BARANG --}}
<div class="mb-3">
    <label class="form-label">Nama Barang</label>
    <input type="text" name="nama_barang"
           class="form-control @error('nama_barang') is-invalid @enderror"
           value="{{ old('nama_barang') }}" required>
</div>

{{-- KATEGORI --}}
<div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="kategori_id" class="form-select" required>
        @foreach($kategori as $item)
            <option value="{{ $item->id }}">{{ $item->nama }}</option>
        @endforeach
    </select>
</div>

{{-- LOKASI --}}
<div class="mb-3">
    <label class="form-label">Lokasi</label>
    <select name="lokasi_id" class="form-select" required>
        @foreach($lokasi as $item)
            <option value="{{ $item->id }}">{{ $item->nama }}</option>
        @endforeach
    </select>
</div>

{{-- JUMLAH --}}
<div class="mb-3">
    <label class="form-label">Jumlah</label>
    <input type="number" name="jumlah" class="form-control" required>
</div>

{{-- SATUAN --}}
<div class="mb-3">
    <label class="form-label">Satuan</label>
    <input type="text" name="satuan" class="form-control" required>
</div>

{{-- KONDISI --}}
<div class="mb-3">
    <label class="form-label">Kondisi</label>
    <select name="kondisi" class="form-select">
        <option value="baik">Baik</option>
        <option value="rusak">Rusak</option>
    </select>
</div>

<button class="btn btn-primary">Simpan</button>
</form>

    </div>
</div>
@endsection
