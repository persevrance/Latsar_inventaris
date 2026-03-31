<?php

namespace App\Actions\Pengembalian;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class ProcessPengembalian
{
    protected $createDetail;
    protected $updateStatus;

    public function __construct(
        CreateDetailPengembalian $createDetail,
        UpdateBarangStatus $updateStatus
    ) {
        $this->createDetail = $createDetail;
        $this->updateStatus = $updateStatus;
    }

    public function execute(Peminjaman $peminjaman, array $items)
    {
        return DB::transaction(function () use ($peminjaman, $items) {

            $pengembalian = Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_kembali' => now(),
            ]);

            foreach ($items as $itemId => $kondisi) {

                $this->createDetail->execute([
                    'pengembalian_id' => $pengembalian->id,
                    'barang_item_id'  => $itemId,
                    'kondisi'         => $kondisi,
                ]);

                $item = $peminjaman->details
                    ->where('barang_item_id', $itemId)
                    ->first()
                    ->barangItem;

                $this->updateStatus->execute($item, $kondisi);
            }

            $peminjaman->update([
                'status' => 'dikembalikan'
            ]);

            return $pengembalian;
        });
    }
}
