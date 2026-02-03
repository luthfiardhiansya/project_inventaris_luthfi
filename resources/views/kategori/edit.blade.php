@extends('layouts.dashboard')

@section('title', 'Edit Kategori')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Edit Kategori</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama', $kategori->nama) }}">

                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control"
                          rows="3">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
