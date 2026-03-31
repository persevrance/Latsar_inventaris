<?php

namespace App\Actions\Barang;

use App\Models\BarangItem;
use Illuminate\Support\Facades\DB;

class UpdateBarangItem
{
    public function execute(BarangItem $item, array $data)
    {
        return DB::transaction(function () use ($item, $data) {
            $item->update([
                'kode_item' => $data['kode_item'] ?? $item->kode_item,
            ]);

            return $item;
        });
    }
}
