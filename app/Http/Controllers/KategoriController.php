<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::latest()->get();
        return view('kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);
        Kategori::create($request->all());

        return back()->with('success','Kategori berhasil ditambahkan');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate(['nama' => 'required']);
        $kategori->update($request->all());

        return back()->with('success','Kategori diperbarui');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return back()->with('success','Kategori dihapus');
    }
}
