@extends('layouts.dashboard')

@section('title', 'Edit Lokasi')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('lokasi.update', $lokasi) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Lokasi</label>
                <input type="text" name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama', $lokasi->nama) }}" required>
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control">{{ old('deskripsi', $lokasi->deskripsi) }}</textarea>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
