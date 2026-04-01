<?php

namespace App\Actions\Barang;

use App\Models\BarangItem;
use Illuminate\Support\Facades\DB;

class UpdateBarangItem
{
    public function execute(BarangItem $item, array $data)
    {
        $status = BarangItem::mapStatusFromKondisi($data['kondisi']);

        if (!in_array($data['kondisi'], BarangItem::KONDISI)) {
            throw new \InvalidArgumentException('Kondisi tidak valid');
        }

        $item->update([
            'kode_item' => $data['kode_item'],
            'kondisi'   => $data['kondisi'],
            'status'    => $status,
        ]);

        return $item;
    }
}
