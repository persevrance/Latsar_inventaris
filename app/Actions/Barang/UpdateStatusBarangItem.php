<?php

namespace App\Actions\Barang;

use App\Models\BarangItem;
use Illuminate\Support\Facades\DB;

class UpdateStatusBarangItem
{
    public function execute(BarangItem $item, string $kondisi)
    {
        return DB::transaction(function () use ($item, $kondisi) {

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
        });
    }
}
