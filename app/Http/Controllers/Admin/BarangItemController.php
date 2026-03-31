<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\Controller;
use App\Models\BarangItem;
use App\DTO\Barang\BarangItemDTO;
use App\Actions\Barang\CreateBarangItem;
use App\Actions\Barang\UpdateBarangItem;

use Illuminate\Http\Request;

class BarangItemController extends Controller
{
    public function store(Request $request, CreateBarangItem $create)
    {
        $dto = BarangItemDTO::fromArray($request->all());

        $create->execute($dto->toArray());

        return back()->with('success', 'Item berhasil ditambahkan');
    }

    public function update(Request $request, BarangItem $item, UpdateBarangItem $update)
    {
        $dto = BarangItemDTO::fromArray($request->all());

        $update->execute($item, $dto->toArray());

        return back()->with('success', 'Item berhasil diupdate');
    }

    public function destroy(BarangItem $item)
    {
        $item->delete();

        return back()->with('success', 'Item dihapus');
    }
}
