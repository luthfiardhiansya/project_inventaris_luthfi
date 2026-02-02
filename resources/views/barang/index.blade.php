@extends('layouts.dashboard')

@section('title', 'Daftar Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 text-gray-800">Daftar Barang</h2>
    <a href="{{ route('barang.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Barang
    </a>
</div>

<form method="GET" class="row g-2 mb-4">
    <div class="col-md-4">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Cari barang..."
            value="{{ request('search') }}"
        >
    </div>

    <div class="col-md-4">
        <select name="kategori" class="form-select">
            <option value="">Semua Kategori</option>
            @foreach($kategori as $item)
                <option
                    value="{{ $item->id }}"
                    {{ request('kategori') == $item->id ? 'selected' : '' }}
                >
                    {{ $item->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-outline-secondary w-100">
            Filter
        </button>
    </div>
</form>

<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Foto</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($barang as $item)
                    <tr>
                        <td>
                            <img
                                src="{{ $item->gambar ? asset('storage/'.$item->gambar) : asset('img/no-image.png') }}"
                                class="rounded"
                                style="width:60px;height:60px;object-fit:cover;background:#f1f3f5;"
                            >
                        </td>

                        <td>{{ $item->nama }}</td>

                        <td>{{ $item->kategori->nama ?? '-' }}</td>

                        <td>{{ $item->jumlah }}</td>

                        <td>
                            <span class="badge bg-{{ $item->kondisi === 'baik' ? 'success' : 'warning' }}">
                                {{ ucfirst($item->kondisi) }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('barang.show', $item) }}"
                               class="btn btn-sm btn-info">
                                Detail
                            </a>

                            <a href="{{ route('barang.edit', $item) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            Data barang kosong
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $barang->links('pagination::bootstrap-5') }}
</div>
@endsection
