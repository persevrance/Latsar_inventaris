<?php

namespace App\Actions\Peminjaman;

use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\BarangItem;
use Illuminate\Support\Facades\DB;

class CreatePeminjaman
{
    public function execute(array $data)
    {
        return DB::transaction(function () use ($data) {

            $peminjaman = Peminjaman::create([
                'user_id' => $data['user_id'],
                'tanggal_pinjam' => now(),
                'status' => 'pending',
            ]);

            foreach ($data['items'] as $itemId) {

                $item = BarangItem::findOrFail($itemId);

                if ($item->status !== 'tersedia') {
                    throw new \Exception("Barang tidak tersedia");
                }

                DetailPeminjaman::create([
                    'peminjaman_id' => $peminjaman->id,
                    'barang_item_id' => $itemId,
                ]);
            }

            return $peminjaman;
        });
    }
}
