<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $data = Barang::with('kategori', 'lokasi')->get();
        return view('admin.barang.index', compact('data'));
    }

    public function create()
    {
        return view('admin.barang.create', [
            'kategori' => Kategori::all(),
            'lokasi' => Lokasi::all()
        ]);
    }

    public function store(Request $request)
    {
        Barang::create($request->all());

        return redirect()->route('admin.barang')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('admin.barang.edit', [
            'data' => Barang::findOrFail($id),
            'kategori' => Kategori::all(),
            'lokasi' => Lokasi::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        Barang::findOrFail($id)->update($request->all());

        return back()->with('success', 'Berhasil diupdate');
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return back()->with('success', 'Berhasil dihapus');
    }

    // Pegawai view
    public function indexPegawai()
    {
        $data = Barang::with('items')->get();
        return view('pegawai.barang.index', compact('data'));
    }
}
