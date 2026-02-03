@extends('layouts.dashboard')

@section('title', 'Detail Lokasi')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr>
                <th width="150">Nama Lokasi</th>
                <td>{{ $lokasi->nama }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{ $lokasi->deskripsi ?? '-' }}</td>
            </tr>
        </table>

        <div class="mt-3">
            <a href="{{ route('lokasi.edit', $lokasi) }}" class="btn btn-warning">
                Edit
            </a>
            <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
