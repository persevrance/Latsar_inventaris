<?php

namespace App\Repositories;

use App\Models\HistoryBarang;

class HistoryRepository extends BaseRepository
{
    public function latest($limit = 20)
    {
        return HistoryBarang::with(['barangItem.barang', 'user'])
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function getByItem($barang_item_id)
    {
        return HistoryBarang::where('barang_item_id', $barang_item_id)
            ->with(['user', 'lokasiAwal', 'lokasiAkhir'])
            ->orderBy('tanggal', 'desc')
            ->get();
    }

    public function getByUser($user_id)
    {
        return HistoryBarang::where('user_id', $user_id)->get();
    }
}
