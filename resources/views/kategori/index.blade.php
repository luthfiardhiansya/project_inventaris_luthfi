@extends('layouts.dashboard')

@section('title', 'Data Kategori')

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
<div class="d-flex justify-content-between mb-4">
    <h2 class="h4">Data Kategori</h2>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Kategori
    </a>
</div>

<form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control"
               placeholder="Cari kategori..." value="{{ request('search') }}">
        <button class="btn btn-outline-secondary">Cari</button>
    </div>
</form>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategori as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->deskripsi ?? '-' }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('kategori.show', $item->id) }}"
                               class="btn btn-sm btn-info text-white">
                                Detail
                            </a>

                            <a href="{{ route('kategori.edit', $item->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('kategori.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus kategori ini?')">
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
                    <td colspan="4" class="text-center">Data kosong</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $kategori->links('pagination::bootstrap-5') }}
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
