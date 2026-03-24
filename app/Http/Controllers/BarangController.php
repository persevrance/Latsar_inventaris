<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Services\BarangService;

class BarangController extends Controller
{
    protected $service;


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

    public function store(BarangRequest $request)
    {
        try {
            $data = $request->validated();

            $this->service->store($data);

            return redirect()
                ->route('admin.barang')
                ->with('success', 'Barang berhasil ditambahkan');
        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        return view('admin.barang.edit', [
            'data' => Barang::findOrFail($id),
            'kategori' => Kategori::all(),
            'lokasi' => Lokasi::all()
        ]);
    }

    public function update(BarangRequest $request, $id)
    {
        try {
            $data = $request->validated();

            $this->service->update($id, $data);

            return redirect()
                ->route('admin.barang')
                ->with('success', 'Barang berhasil diperbarui');
        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
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
