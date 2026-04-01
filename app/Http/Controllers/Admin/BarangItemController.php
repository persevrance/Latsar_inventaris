<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\Controller;
use App\Models\BarangItem;
use App\DTO\Barang\BarangItemDTO;
use App\Actions\Barang\CreateBarangItem;
use App\Actions\Barang\UpdateBarangItem;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangItemController extends Controller
{

    public function index($barangId)
    {
        $barang = Barang::with('items')->findOrFail($barangId);

        return view('pages.admin.barangItem.index', [
            'barang' => $barang,
            'items' => $barang->items
        ]);
    }
    public function store(Request $request, $barangId, CreateBarangItem $create)
    {
        $dto = BarangItemDTO::fromArray([
            ...$request->all(),
            'barang_id' => $barangId
        ]);

        $create->execute($dto->toArray());

        return back()->with('success', 'Item berhasil ditambahkan');
    }

    public function update(Request $request, $barangId, BarangItem $item, UpdateBarangItem $update)
    {
        if ($item->barang_id != $barangId) {
            abort(404);
        }

        $dto = BarangItemDTO::fromArray([
            ...$request->all(),
            'barang_id' => $barangId
        ]);

        $update->execute($item, $dto->toArray());

        return back()->with('success', 'Item berhasil diupdate');
    }

    public function destroy($barangId, BarangItem $item)
    {
        if ($item->barang_id != $barangId) {
            abort(404);
        }

        $item->delete();

        return back()->with('success', 'Item dihapus');
    }
}
