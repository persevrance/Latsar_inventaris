<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Base\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('pages.master.kategori.index', [
            'kategori' => Kategori::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        Kategori::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $kategori->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        return redirect()
            ->back()
            ->with('success', 'Kategori berhasil dihapus');
    }
}
