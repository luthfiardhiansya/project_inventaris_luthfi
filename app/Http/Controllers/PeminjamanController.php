<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{

    public function index()
    {
        $peminjaman = Peminjaman::with('barang','user')
            ->latest()
            ->get();

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $barang = Barang::where('jumlah','>',0)->get();
        return view('peminjaman.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam'  => 'required',
            'jenis_peminjam' => 'required|in:siswa,guru,umum',
            'barang_id'      => 'required|exists:barang,id',
            'jumlah'         => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {

            $barang = Barang::lockForUpdate()->find($request->barang_id);

            if ($request->jumlah > $barang->jumlah) {
                abort(400, 'Stok tidak mencukupi');
            }

            $barang->decrement('jumlah', $request->jumlah);

            Peminjaman::create([
                'kode_peminjaman' => 'PMJ-' . time(),
                'nama_peminjam'   => $request->nama_peminjam,
                'jenis_peminjam'  => $request->jenis_peminjam,
                'barang_id'       => $request->barang_id,
                'jumlah'          => $request->jumlah,
                'tanggal_pinjam'  => $request->tanggal_pinjam,
                'user_id'         => auth()->id(),
            ]);
        });

        return redirect()->route('peminjaman.index')
            ->with('success','Peminjaman berhasil');
    }

    public function update(Peminjaman $peminjaman)
    {
        DB::transaction(function () use ($peminjaman) {

            $peminjaman->barang->increment('jumlah', $peminjaman->jumlah);

            $peminjaman->delete();
        });

        return redirect()->route('peminjaman.index')
            ->with('success','Barang berhasil dikembalikan');
    }
}
