<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $barang = Barang::with(['kategori', 'lokasi'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%');
            })
            ->when($request->kategori, function ($q) use ($request) {
                $q->where('kategori_id', $request->kategori);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $kategori = Kategori::all();

        return view('barang.index', compact('barang', 'kategori'));
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
            'kode_barang' => 'required|unique:barang,kode_barang',
            'nama_barang' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'lokasi_id'   => 'required|exists:lokasi,id',
            'kondisi'     => 'required|in:baik,rusak',
            'jumlah'      => 'required|integer|min:0',
            'satuan'      => 'required|string',
        ]);

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
            'nama_barang' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'lokasi_id'   => 'required|exists:lokasi,id',
            'kondisi'     => 'required|in:baik,rusak',
            'jumlah'      => 'required|integer|min:0',
            'satuan'      => 'required|string',
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
