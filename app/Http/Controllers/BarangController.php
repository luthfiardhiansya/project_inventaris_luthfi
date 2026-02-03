<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $barang = Barang::with(['kategori', 'lokasi'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        return view('barang.create', [
            'kategori' => Kategori::all(),
            'lokasi'   => Lokasi::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategori,id',
            'lokasi_id'   => 'required|exists:lokasi,id',
            'jumlah'      => 'required|integer|min:0',
            'satuan'      => 'required|string|max:20',
            'kondisi'     => 'required|in:baik,rusak',
        ]);

        do {
            $kode = 'BRG-' . strtoupper(Str::random(6));
        } while (Barang::where('kode_barang', $kode)->exists());

        $validated['kode_barang'] = $kode;

        Barang::create($validated);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', [
            'barang'   => $barang,
            'kategori' => Kategori::all(),
            'lokasi'   => Lokasi::all(),
        ]);
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategori,id',
            'lokasi_id'   => 'required|exists:lokasi,id',
            'jumlah'      => 'required|integer|min:0',
            'satuan'      => 'required|string|max:20',
            'kondisi'     => 'required|in:baik,rusak',
        ]);

        $barang->update($validated);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil dihapus');
    }
}
