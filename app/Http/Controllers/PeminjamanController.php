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
        $peminjaman = Peminjaman::with(['barang','user'])->latest()->get();
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
            'kode_peminjaman' => 'required|unique:peminjaman',
            'nama_peminjam'   => 'required',
            'jenis_peminjam'  => 'required',
            'barang_id'       => 'required',
            'jumlah'          => 'required|integer|min:1',
            'tanggal_pinjam'  => 'required|date',
        ]);

        DB::transaction(function () use ($request) {

            $barang = Barang::lockForUpdate()->find($request->barang_id);

            if ($request->jumlah > $barang->jumlah) {
                abort(400,'Stok tidak mencukupi');
            }

            $barang->decrement('jumlah', $request->jumlah);

            Peminjaman::create([
                'kode_peminjaman' => $request->kode_peminjaman,
                'nama_peminjam'   => $request->nama_peminjam,
                'jenis_peminjam'  => $request->jenis_peminjam,
                'barang_id'       => $request->barang_id,
                'jumlah'          => $request->jumlah,
                'tanggal_pinjam'  => $request->tanggal_pinjam,
                'status'          => 'dipinjam',
                'user_id'         => auth()->id(),
            ]);
        });

        return redirect()->route('peminjaman.index')
            ->with('success','Peminjaman berhasil');
    }

    public function update(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error','Sudah dikembalikan');
        }

        DB::transaction(function () use ($peminjaman) {
            $peminjaman->barang->increment('jumlah', $peminjaman->jumlah);
            $peminjaman->update([
                'status' => 'dikembalikan',
                'tanggal_kembali' => now()
            ]);
        });

        return back()->with('success','Barang dikembalikan');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dipinjam') {
            return back()->with('error','Tidak bisa hapus peminjaman aktif');
        }

        $peminjaman->delete();
        return back()->with('success','Data dihapus');
    }
}
