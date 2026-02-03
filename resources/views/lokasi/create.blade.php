@extends('layouts.dashboard')

@section('title', 'Tambah Lokasi')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('lokasi.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Lokasi</label>
                <input type="text" name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama') }}" required>
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
