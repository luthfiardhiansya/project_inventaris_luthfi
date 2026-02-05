@extends('layouts.dashboard')

@section('title', 'Data Barang')

@section('content')
<div class="container">

    <h4 class="mb-3">Data Barang</h4>

    @if(session('success'))
        <div class="alert alert-success" id="flash-msg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" id="flash-msg">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">
        + Tambah Barang
    </a>

    <a href="{{ route('barang.export') }}" class="btn btn-success mb-3">
        <i class="bx bx-download"></i> Export Excel
    </a>

    {{-- SEARCH & FILTER (GAYA RINGAN) --}}
    <form method="GET" action="{{ route('barang.index') }}" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari nama / kode barang..."
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <select name="kategori" class="form-select">
                <option value="">-- Semua Kategori --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}"
                        {{ request('kategori') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-5">
            <button class="btn btn-primary">
                <i class="bx bx-search"></i> Cari
            </button>

            <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                <i class="bx bx-refresh"></i> Reset
            </a>
        </div>
    </form>

    {{-- TABLE --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Kondisi</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barang as $item)
            <tr>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->kategori->nama ?? '-' }}</td>
                <td>{{ $item->lokasi->nama ?? '-' }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp {{ number_format($item->satuan, 0, ',', '.') }}</td>
                <td>
                    <span class="badge bg-{{ $item->kondisi == 'baik' ? 'success' : 'danger' }}">
                        {{ strtoupper($item->kondisi) }}
                    </span>
                </td>
                <td>
    <div class="d-flex align-items-center gap-1">
        <a href="{{ route('barang.show', $item->id) }}"
           class="btn btn-sm btn-info text-white">
            Detail
        </a>

        <a href="{{ route('barang.edit', $item->id) }}"
           class="btn btn-sm btn-warning">
            Edit
        </a>

        <form action="{{ route('barang.destroy', $item->id) }}"
              method="POST"
              onsubmit="return confirm('Hapus barang ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">
                Hapus
            </button>
        </form>
    </div>
</td>

            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted">
                    Data barang belum ada
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $barang->links() }}

</div>

<script>
    setTimeout(() => {
        const msg = document.getElementById('flash-msg');
        if (msg) msg.remove();
    }, 3000);
</script>
@endsection
