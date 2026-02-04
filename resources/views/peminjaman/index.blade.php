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
            @forelse ($peminjaman as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->kode_peminjaman }}</td>
                    <td>{{ $p->nama_peminjam }}</td>

                    <td>
                    @if ($p->barang->count())
                            @foreach ($p->barang as $b)
                            {{ $b->nama_barang }}
                            @endforeach
                    @else
                        <span class="text-muted">-</span>
                    @endif
                    </td>

                    <td>
                    @if ($p->barang->count())
                            @foreach ($p->barang as $b)
                                {{ $b->pivot->jumlah }} 
                            @endforeach
                    @else
                        <span class="text-muted">-</span>
                    @endif
                    </td>

                    <td>{{ $p->tanggal_pinjam }}</td>

                    <td>
                        <span class="badge bg-{{ $p->status === 'dipinjam' ? 'warning' : 'success' }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>

                    <td>
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
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
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