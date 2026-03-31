<?php

namespace App\Actions\Pengembalian;

use App\Models\DetailPengembalian;

class CreateDetailPengembalian
{
    public function execute(array $data)
    {
        return DetailPengembalian::create([
            'pengembalian_id' => $data['pengembalian_id'],
            'barang_item_id'  => $data['barang_item_id'],
            'kondisi'         => $data['kondisi'],
        ]);
    }
}
