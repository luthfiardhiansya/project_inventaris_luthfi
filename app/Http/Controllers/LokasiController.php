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

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);
        Lokasi::create($request->all());

        return back()->with('success','Lokasi ditambahkan');
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $request->validate(['nama' => 'required']);
        $lokasi->update($request->all());

        return back()->with('success','Lokasi diperbarui');
    }

    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();
        return back()->with('success','Lokasi dihapus');
    }
}
