@extends('layouts.dashboard')

@section('title', 'Detail Kategori')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Detail Kategori</h5>
    </div>

    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr>
                <th width="200">Nama Kategori</th>
                <td>{{ $kategori->nama }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{ $kategori->deskripsi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Dibuat</th>
                <td>{{ $kategori->created_at->format('d M Y H:i') }}</td>
            </tr>
            <tr>
                <th>Terakhir Diubah</th>
                <td>{{ $kategori->updated_at->format('d M Y H:i') }}</td>
            </tr>
        </table>
    </div>

    <div class="card-footer">
        <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
