@extends('layouts.dashboard')

@section('title', 'Data Peminjaman')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Data Peminjaman</h4>

    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
        <i class="bx bx-plus"></i> Tambah Data
    </a>
</div>

{{-- ALERT --}}
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


<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Peminjam</th>
                    <th>Jenis</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjaman as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_peminjaman }}</td>
                    <td>{{ $item->nama_peminjam }}</td>
                    <td class="text-capitalize">{{ $item->jenis_peminjam }}</td>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                    <td class="text-center">
                        <form action="{{ route('peminjaman.update', $item->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-success btn-sm"
                                    onclick="return confirm('Kembalikan barang ini?')">
                                Kembalikan
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        Tidak ada peminjaman aktif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
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
