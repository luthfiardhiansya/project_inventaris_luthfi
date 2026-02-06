@extends('layouts.dashboard')

@section('title', 'Detail Barang')

@section('content')
<div class="container">

    <h4 class="mb-3">Detail Barang</h4>

    <a href="{{ route('barang.index') }}" class="btn btn-secondary mb-3">
        ← Kembali
    </a>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-4 text-center">
    @if($barang->foto)
        <div class="foto-wrapper mx-auto">
            <img src="{{ Storage::url($barang->foto) }}" alt="Foto Barang">
        </div>
    @else
        <div class="text-muted">Tidak ada foto</div>
    @endif
</div>

                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">Kode Barang</th>
                            <td>{{ $barang->kode_barang }}</td>
                        </tr>
                        <tr>
                            <th>Nama Barang</th>
                            <td>{{ $barang->nama_barang }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $barang->kategori->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>{{ $barang->lokasi->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td>{{ $barang->jumlah }}</td>
                        </tr>
                        <tr>
                            <th>Harga Satuan</th>
                            <td>Rp {{ number_format($barang->satuan, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Kondisi</th>
                            <td>
                                <span class="badge bg-{{ $barang->kondisi == 'baik' ? 'success' : 'danger' }}">
                                    {{ strtoupper($barang->kondisi) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Beli</th>
                            <td>{{ $barang->tanggal_beli ? \Carbon\Carbon::parse($barang->tanggal_beli)->format('d M Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $barang->deskripsi ?? '-' }}</td>
                        </tr>
                    </table>

                    <div class="d-flex gap-2">
                        <a href="{{ route('barang.edit', $barang->id) }}"
                           class="btn btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('barang.destroy', $barang->id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus barang ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<style>
    .foto-wrapper {
    width: 250px;
    height: 250px;
    border-radius: 8px;
    overflow: hidden;
    background: #f5f5f5;
}

.foto-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

</style>
@endsection
