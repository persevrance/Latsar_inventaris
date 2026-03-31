<?php

namespace App\Actions\Pengembalian;

use App\Models\BarangItem;

class UpdateBarangStatus
{
    public function execute(BarangItem $item, string $kondisi)
    {
        $status = match ($kondisi) {
            'baik'   => 'tersedia',
            'rusak'  => 'maintenance',
            'hilang' => 'nonaktif',
            default  => $item->status,
        };

        $item->update([
            'kondisi' => $kondisi,
            'status'  => $status,
        ]);

        return $item;
    }
}
