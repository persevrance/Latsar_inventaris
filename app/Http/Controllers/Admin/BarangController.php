<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Barang\CreateBarang;
use App\Actions\Barang\DeleteBarang;
use App\Actions\Barang\UpdateBarang;
use App\Http\Controllers\Base\Controller;
use App\Models\Barang;
use App\DTO\Barang\BarangDTO;
use App\DTO\Barang\UpdateBarangDTO;
use App\Models\Kategori;
use App\Http\Requests\BarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\Lokasi;

class BarangController extends Controller
{
    public function index()
    {
        return view('pages.admin.barang.index', [
            'kategori' => Kategori::all(),
            'lokasi' => Lokasi::all(),
            'barang' => Barang::latest()->get()
        ]);
    }

    public function store(BarangRequest $request, CreateBarang $action)
    {
        $dto = BarangDTO::fromArray($request->validated());

        $action->execute($dto);

        return back()->with('success', 'Barang berhasil ditambahkan');
    }

    public function update(UpdateBarangRequest $request, Barang $barang, UpdateBarang $action)
    {
        $dto = BarangDTO::fromArray($request->validated());

        $action->execute($barang, $dto);

        return back()->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(Barang $barang, DeleteBarang $action)
    {
        try {
            $action->execute($barang);

            return back()->with('success', 'Barang berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('pages.admin.barang.create', [
            'lokasi' => Lokasi::all(),
            'kategori' => Kategori::all()
        ]);
    }
}
