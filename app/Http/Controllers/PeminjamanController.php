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
        $peminjaman = Peminjaman::with(['barang', 'user'])
            ->latest()
            ->get();

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $barang = Barang::where('jumlah', '>', 0)->get();
        return view('peminjaman.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam'  => 'required',
            'jenis_peminjam' => 'required|in:siswa,guru,staf,luar',
            'tanggal_pinjam' => 'required|date',
            'barang_id'      => 'required|array',
            'jumlah'         => 'required|array',
        ]);

        try {
            DB::transaction(function () use ($request) {

                $peminjaman = Peminjaman::create([
                    'kode_peminjaman' => 'PMJ-' . time(),
                    'nama_peminjam'   => $request->nama_peminjam,
                    'jenis_peminjam'  => $request->jenis_peminjam,
                    'tanggal_pinjam'  => $request->tanggal_pinjam,
                    'status'          => 'dipinjam',
                    'user_id'         => auth()->id(),
                ]);

                foreach ($request->barang_id as $i => $barangId) {

                    $barang = Barang::lockForUpdate()->findOrFail($barangId);

                    if ($request->jumlah[$i] > $barang->jumlah) {
                        throw new \Exception('Stok barang tidak mencukupi');
                    }

                    $barang->decrement('jumlah', $request->jumlah[$i]);

                    $peminjaman->barang()->attach($barangId, [
                        'jumlah' => $request->jumlah[$i],
                        'kondisi_sebelum' => $barang->kondisi,
                    ]);
                }
            });

            return redirect()->route('peminjaman.index')
                ->with('success', 'Peminjaman berhasil disimpan');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function update(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dikembalikan') {
            return back();
        }

        DB::transaction(function () use ($peminjaman) {

            foreach ($peminjaman->barang as $barang) {
                $barang->increment('jumlah', $barang->pivot->jumlah);
            }

            $peminjaman->update([
                'status' => 'dikembalikan',
                'tanggal_kembali' => now(),
            ]);
        });

        return back()->with('success', 'Barang berhasil dikembalikan');
    }
}
