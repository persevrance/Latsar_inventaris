<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\Controller;
use App\Models\Barang;
use App\DTO\Barang\BarangDTO;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        return view('admin.barang.index', [
            'data' => Barang::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $dto = BarangDTO::fromRequest($request);

        Barang::create((array) $dto);

        return back()->with('success', 'Barang berhasil ditambahkan');
    }

    public function update(Request $request, Barang $barang)
    {
        $dto = BarangDTO::fromRequest($request);

        $barang->update((array) $dto);

        return back()->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return back()->with('success', 'Barang dihapus');
    }
}
