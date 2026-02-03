@extends('layouts.dashboard')

@section('title', 'Edit Barang')

@section('content')
<h2 class="h4 mb-4">Edit Barang</h2>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <form action="{{ route('barang.update', $barang->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- KODE BARANG (READONLY) --}}
            <div class="mb-3">
                <label class="form-label">Kode Barang</label>
                <input type="text" class="form-control" value="{{ $barang->kode_barang }}" readonly>
            </div>

            {{-- NAMA --}}
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang"
                       class="form-control"
                       value="{{ old('nama_barang', $barang->nama_barang) }}" required>
            </div>

            {{-- KATEGORI --}}
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori_id" class="form-select" required>
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}"
                            {{ $barang->kategori_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- LOKASI --}}
            <div class="mb-3">
                <label class="form-label">Lokasi</label>
                <select name="lokasi_id" class="form-select" required>
                    @foreach($lokasi as $item)
                        <option value="{{ $item->id }}"
                            {{ $barang->lokasi_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- JUMLAH --}}
            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah"
                       class="form-control"
                       value="{{ $barang->jumlah }}" required>
            </div>

            {{-- SATUAN --}}
            <div class="mb-3">
                <label class="form-label">Satuan</label>
                <input type="text" name="satuan"
                       class="form-control"
                       value="{{ $barang->satuan }}" required>
            </div>

            {{-- KONDISI --}}
            <div class="mb-3">
                <label class="form-label">Kondisi</label>
                <select name="kondisi" class="form-select">
                    <option value="baik" {{ $barang->kondisi == 'baik' ? 'selected' : '' }}>
                        Baik
                    </option>
                    <option value="rusak" {{ $barang->kondisi == 'rusak' ? 'selected' : '' }}>
                        Rusak
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection
