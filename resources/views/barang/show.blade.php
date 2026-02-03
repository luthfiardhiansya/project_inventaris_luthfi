@extends('layouts.dashboard')

@section('title', 'Detail Barang')

@section('content')
<h2 class="h4 mb-4">Detail Barang</h2>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <table class="table table-bordered">
            <tr>
                <th width="200">Kode Barang</th>
                <td>{{ $barang->kode_barang }}</td>
            </tr>
            <tr>
                <th>Nama Barang</th>
                <td>{{ $barang->nama_barang }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>{{ $barang->kategori->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>Lokasi</th>
                <td>{{ $barang->lokasi->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>{{ $barang->jumlah }} {{ $barang->satuan }}</td>
            </tr>
            <tr>
                <th>Kondisi</th>
                <td>{{ ucfirst($barang->kondisi) }}</td>
            </tr>
        </table>

        <div class="d-flex gap-2">
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                Kembali
            </a>
            <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning">
                Edit
            </a>
        </div>

    </div>
</div>
@endsection
