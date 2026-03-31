<?php

namespace App\Repositories;

use App\Models\HistoryBarang;

class HistoryRepository
{
    public function getAll()
    {
        return HistoryBarang::latest()->get();
    }

    public function filter(array $data)
    {
        $query = HistoryBarang::query();

        if (!empty($data['tanggal_awal'])) {
            $query->whereDate('created_at', '>=', $data['tanggal_awal']);
        }

        if (!empty($data['tanggal_akhir'])) {
            $query->whereDate('created_at', '<=', $data['tanggal_akhir']);
        }

        if (!empty($data['barang_id'])) {
            $query->where('barang_id', $data['barang_id']);
        }

        if (!empty($data['status'])) {
            $query->where('status', $data['status']);
        }

        return $query->latest()->get();
    }

    public function create(array $data): HistoryBarang
    {
        return HistoryBarang::create($data);
    }
}
