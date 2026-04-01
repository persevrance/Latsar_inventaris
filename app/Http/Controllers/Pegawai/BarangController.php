<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Base\Controller;
use App\Models\Barang;
use App\Models\BarangItem;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        return view('pages.pegawai.barang.index', [
            'barang' => Barang::with('items')->latest()->get()
        ]);
    }

    public function getItems($id)
    {
        $items = BarangItem::where('barang_id', $id)->get();

        return response()->json($items);
    }
}
