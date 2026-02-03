@extends('layouts.dashboard')

@section('title', 'Data Lokasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Lokasi</h4>
    <a href="{{ route('lokasi.create') }}" class="btn btn-primary">
        Tambah Lokasi
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">#</th>
                    <th>Nama Lokasi</th>
                    <th>Deskripsi</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lokasi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->deskripsi }}</td>
<td>
    <div class="d-flex gap-2">
        <a href="{{ route('lokasi.show', $item->id) }}"
           class="btn btn-info btn-sm">
            Detail
        </a>

        <a href="{{ route('lokasi.edit', $item->id) }}"
           class="btn btn-warning btn-sm">
            Edit
        </a>

        <form action="{{ route('lokasi.destroy', $item->id) }}"
              method="POST"
              onsubmit="return confirm('Yakin hapus lokasi ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">
                Hapus
            </button>
        </form>
    </div>
</td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-3">
                        Data lokasi belum ada
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
