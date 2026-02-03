@extends('layouts.dashboard')

@section('title', 'Data Barang')

@section('content')
@if(session('success'))
    <div class="alert alert-success auto-dismiss">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger auto-dismiss">
        {{ session('error') }}
    </div>
@endif
<h2 class="h4 mb-4">Data Barang</h2>


<div class="card border-0 shadow-sm">
    <div class="card-body">

        <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">
            + Tambah Barang
        </a>

        <table class="table table-hover align-middle">
            <thead class="table-light">
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
                            {{ ucfirst($item->kondisi) }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
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
                                <button class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Data barang belum ada
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $barang->links() }}

    </div>
</div>

<script>
    setTimeout(() => {
        document.querySelectorAll('.auto-dismiss').forEach(el => {
            el.classList.add('fade');
            el.classList.remove('show');

            setTimeout(() => el.remove(), 500);
        });
    }, 3000);
</script>
@endsection
