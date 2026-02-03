@extends('layouts.dashboard')

@section('title', 'Tambah Barang')

@section('content')
<h2 class="h4 mb-4">Tambah Barang</h2>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <form action="{{ route('barang.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang"
                       class="form-control @error('nama_barang') is-invalid @enderror"
                       value="{{ old('nama_barang') }}" required>

                @error('nama_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori_id"
                        class="form-select @error('kategori_id') is-invalid @enderror"
                        required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}"
                            {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Lokasi</label>
                <select name="lokasi_id"
                        class="form-select @error('lokasi_id') is-invalid @enderror"
                        required>
                    <option value="">-- Pilih Lokasi --</option>
                    @foreach($lokasi as $item)
                        <option value="{{ $item->id }}"
                            {{ old('lokasi_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah"
                       class="form-control @error('jumlah') is-invalid @enderror"
                       value="{{ old('jumlah', 0) }}" min="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Satuan harga</label>
                <input type="text" name="satuan"
                       class="form-control @error('satuan') is-invalid @enderror"
                       value="{{ old('satuan') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kondisi</label>
                <select name="kondisi" class="form-select" required>
                    <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>
                        Baik
                    </option>
                    <option value="rusak" {{ old('kondisi') == 'rusak' ? 'selected' : '' }}>
                        Rusak
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection
