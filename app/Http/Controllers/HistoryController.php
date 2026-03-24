<?php

namespace App\Http\Controllers;

use App\Models\HistoryBarang;

class HistoryController extends Controller
{
    public function index()
    {
        $data = HistoryBarang::with('barangItem.barang', 'user')
            ->latest()
            ->get();

        return view('admin.history.index', compact('data'));
    }

    public function show($id)
    {
        $data = HistoryBarang::where('barang_item_id', $id)
            ->with('user')
            ->get();

        return view('admin.history.detail', compact('data'));
    }
}
