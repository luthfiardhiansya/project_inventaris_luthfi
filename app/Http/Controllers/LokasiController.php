<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::latest()->get();
        return view('lokasi.index', compact('lokasi'));
    }

    public function create()
    {
        return view('lokasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Lokasi::create($validated);

        return redirect()
            ->route('lokasi.index')
            ->with('success', 'Lokasi berhasil ditambahkan');
    }

    public function show(Lokasi $lokasi)
    {
        return view('lokasi.show', compact('lokasi'));
    }

    public function edit(Lokasi $lokasi)
    {
        return view('lokasi.edit', compact('lokasi'));
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $lokasi->update($validated);

        return redirect()
            ->route('lokasi.index')
            ->with('success', 'Lokasi berhasil diperbarui');
    }

    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();

        return redirect()
            ->route('lokasi.index')
            ->with('success', 'Lokasi berhasil dihapus');
    }
}
