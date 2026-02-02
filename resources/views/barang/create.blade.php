@extends('layouts.dashboard')

@section('title', 'Tambah Barang')

@section('content')
<h2 class="h3 mb-4">Tambah Barang</h2>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama') }}" required>
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori_id"
                        class="form-select @error('kategori_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}"
                            {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah"
                       class="form-control @error('jumlah') is-invalid @enderror"
                       value="{{ old('jumlah') }}" required>
                @error('jumlah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kondisi</label>
                <select name="kondisi" class="form-select">
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar</label>
                <input type="file" name="gambar" class="form-control">
            </div>

            <div class="text-end">
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
