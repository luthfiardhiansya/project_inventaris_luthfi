@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h4>Tambah Peminjaman</h4>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Peminjam</label>
            <input type="text" name="nama_peminjam" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenis Peminjam</label>
            <select name="jenis_peminjam" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="siswa">Siswa</option>
                <option value="guru">Guru</option>
                <option value="staf">Staf</option>
                <option value="luar">Luar</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" required>
        </div>

        <hr>

        <h5>Barang Dipinjam</h5>

        <div id="barang-wrapper">
            <div class="row mb-2">
                <div class="col-md-6">
                    <select name="barang_id[]" class="form-control" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barang as $b)
                            <option value="{{ $b->id }}">
                                {{ $b->nama_barang }} (stok: {{ $b->jumlah }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="number"
                           name="jumlah[]"
                           class="form-control"
                           min="1"
                           placeholder="Jumlah"
                           required>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="tambahBarang()">
            + Tambah Barang
        </button>

        <br>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
function tambahBarang() {
    const wrapper = document.getElementById('barang-wrapper');
    wrapper.insertAdjacentHTML('beforeend', `
        <div class="row mb-2">
            <div class="col-md-6">
                <select name="barang_id[]" class="form-control" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($barang as $b)
                        <option value="{{ $b->id }}">
                            {{ $b->nama_barang }} (stok: {{ $b->jumlah }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <input type="number"
                       name="jumlah[]"
                       class="form-control"
                       min="1"
                       placeholder="Jumlah"
                       required>
            </div>
        </div>
    `);
}
</script>
@endsection
