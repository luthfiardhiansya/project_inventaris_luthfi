@extends('layouts.dashboard')

@section('content')
<div class="container">

    <h4 class="mb-3">Data Peminjaman</h4>

    @if(session('success'))
        <div class="alert alert-success" id="flash-msg">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">
        + Tambah Peminjaman
    </a>
    <a href="{{ route('peminjaman.export') }}" class="btn btn-success mb-3">
    <i class="bx bx-download"></i> Export Excel
    </a>

    <form action="{{ route('peminjaman.index') }}" method="GET" class="row g-2 mb-3">
    <div class="col-md-4">
        <input 
            type="text" 
            name="search" 
            class="form-control"
            placeholder="Cari kode / nama peminjam..."
            value="{{ request('search') }}"
        >
    </div>

    <div class="col-md-3">
        <input 
            type="date" 
            name="tanggal" 
            class="form-control"
            value="{{ request('tanggal') }}"
        >
    </div>

    <div class="col-md-5">
        <button class="btn btn-primary">
            <i class="bx bx-search"></i> Cari
        </button>

        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
            <i class="bx bx-refresh"></i> Reset
        </a>
    </div>
</form>



    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Peminjam</th>
                <th>Barang Dipinjam</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
@php $no = 1; @endphp

@forelse ($peminjaman as $p)
    @php
        $jumlahBarang = $p->barang->count();
    @endphp

    @if($jumlahBarang > 0)
        @foreach ($p->barang as $index => $b)
            <tr>
                @if ($index == 0)
                    <td rowspan="{{ $jumlahBarang }}">{{ $no++ }}</td>
                    <td rowspan="{{ $jumlahBarang }}">{{ $p->kode_peminjaman }}</td>
                    <td rowspan="{{ $jumlahBarang }}">{{ $p->nama_peminjam }}</td>
                @endif

                <td>{{ $b->nama_barang }}</td>
                <td>{{ $b->pivot->jumlah }}</td>

                @if ($index == 0)
                    <td rowspan="{{ $jumlahBarang }}">{{ $p->tanggal_pinjam }}</td>
                    <td rowspan="{{ $jumlahBarang }}">
                        <span class="badge bg-{{ $p->status === 'dipinjam' ? 'warning' : 'success' }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                    <td rowspan="{{ $jumlahBarang }}">
                        @if($p->status === 'dipinjam')
                            <form action="{{ route('peminjaman.update', $p->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-sm btn-success">
                                    Kembalikan
                                </button>
                            </form>
                        @else
                            <span class="text-muted">Selesai</span>
                        @endif
                    </td>
                @endif
            </tr>
        @endforeach
    @else
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $p->kode_peminjaman }}</td>
            <td>{{ $p->nama_peminjam }}</td>
            <td class="text-muted">-</td>
            <td class="text-muted">-</td>
            <td>{{ $p->tanggal_pinjam }}</td>
            <td>
                <span class="badge bg-secondary">-</span>
            </td>
            <td class="text-muted">-</td>
        </tr>
    @endif
@empty
    <tr>
        <td colspan="8" class="text-center text-muted">
            Data peminjaman belum ada
        </td>
    </tr>
@endforelse
</tbody>

    </table>

</div>

<script>
    setTimeout(() => {
        const msg = document.getElementById('flash-msg');
        if (msg) msg.remove();
    }, 3000);
</script>
@endsection