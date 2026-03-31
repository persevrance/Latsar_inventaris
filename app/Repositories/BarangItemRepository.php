<?php

namespace App\Repositories;

use App\Models\BarangItem;

class BarangItemRepository
{
    public function findById(int $id): BarangItem
    {
        return BarangItem::findOrFail($id);
    }

    public function create(array $data): BarangItem
    {
        return BarangItem::create($data);
    }

    public function update(BarangItem $item, array $data): BarangItem
    {
        $item->update($data);
        return $item;
    }

    public function delete(BarangItem $item): void
    {
        $item->delete();
    }

    public function getAvailable()
    {
        return BarangItem::where('status', 'tersedia')->get();
    }
}
