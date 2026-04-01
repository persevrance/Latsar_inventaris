<?php

namespace App\Actions\Peminjaman;

use App\DTO\Peminjaman\PeminjamanDTO;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\BarangItem;
use Illuminate\Support\Facades\DB;

class CreatePeminjaman
{
    public function execute(PeminjamanDTO $dto)
    {
        return DB::transaction(function () use ($dto) {

            $peminjaman = Peminjaman::create([
                'user_id' => $dto->user_id,
                'tanggal_pengajuan' => now(),
                'tanggal_pinjam' => $dto->tanggal_pinjam,
                'tanggal_kembali_rencana' => $dto->tanggal_kembali_rencana,
                'keterangan' => $dto->keterangan,
                'status' => 'pending',
            ]);

            foreach ($dto->getItemIds() as $itemId) {

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
