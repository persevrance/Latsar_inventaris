<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Base\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        return view('pages.master.lokasi.index', [
            'lokasi' => Lokasi::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lokasi' => 'required|string|max:255'
        ]);

        Lokasi::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Lokasi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $lokasi = Lokasi::findOrFail($id);

        $validated = $request->validate([
            'nama_lokasi' => 'required|string|max:255'
        ]);

        $lokasi->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Lokasi berhasil diupdate');
    }

    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);

        $lokasi->delete();

        return redirect()
            ->back()
            ->with('success', 'Lokasi berhasil dihapus');
    }
}
