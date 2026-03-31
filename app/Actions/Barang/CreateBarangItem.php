<?php

namespace App\Actions\Barang;

use App\Models\BarangItem;
use Illuminate\Support\Facades\DB;

class CreateBarangItem
{
    public function execute(array $data)
    {
        return DB::transaction(function () use ($data) {
            return BarangItem::create([
                'barang_id' => $data['barang_id'],
                'kode_item' => $data['kode_item'],
                'status'    => 'tersedia',
                'kondisi'   => 'baik',
            ]);
        });
    }
}
