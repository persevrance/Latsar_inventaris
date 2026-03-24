<?php

namespace App\Services;

use App\Models\HistoryBarang;

class HistoryService
{
    public function getByItem($barang_item_id)
    {
        return HistoryBarang::where('barang_item_id', $barang_item_id)
            ->with('user')
            ->latest()
            ->get();
    }

    public function latest($limit = 10)
    {
        return HistoryBarang::with('barangItem.barang', 'user')
            ->latest()
            ->limit($limit)
            ->get();
    }
}
