<?php

namespace App\Actions\Pengembalian;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use App\Actions\History\CreateHistoryBarang;

class ProcessPengembalian
{
    protected $createDetail;
    protected $updateStatus;
    protected $history;

    public function __construct(
        CreateDetailPengembalian $createDetail,
        UpdateBarangStatus $updateStatus,
        CreateHistoryBarang $history
    ) {
        $this->createDetail = $createDetail;
        $this->updateStatus = $updateStatus;
        $this->history = $history;
    }

    public function execute(Peminjaman $peminjaman, array $items, array $catatan = [])
    {
        return DB::transaction(function () use ($peminjaman, $items, $catatan) {

            $pengembalian = Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_kembali' => now(),
            ]);

            foreach ($items as $itemId => $kondisi) {

                // NORMALISASI KONDISI
                $kondisi = strtolower(trim($kondisi));

                // VALIDASI 
                if (!in_array($kondisi, ['baik', 'rusak', 'hilang'])) {
                    throw new \Exception("Kondisi tidak valid: " . $kondisi);
                }

                $item = $peminjaman->details
                    ->where('barang_item_id', $itemId)
                    ->first()
                    ->barangItem;

                $oldKondisi = $item->kondisi;

                $this->createDetail->execute([
                    'pengembalian_id' => $pengembalian->id,
                    'barang_item_id'  => $itemId,
                    'kondisi'         => $kondisi,
                    'catatan' => $catatan[$itemId] ?? null
                ]);

                $this->updateStatus->execute($item, $kondisi);

                $this->history->execute([
                    'barang_item_id' => $item->id,
                    'aktivitas' => 'dikembalikan',
                    'kondisi_awal' => $oldKondisi,
                    'kondisi_akhir' => $kondisi,
                    'lokasi_awal' => null,
                    'lokasi_akhir' => $item->lokasi_id,
                    'user_id' => $peminjaman->user_id,
                    'actor_id' => auth()->id(),
                    'referensi_id' => $pengembalian->id,
                    'keterangan' => 'Pengembalian barang'
                ]);
            }

            $peminjaman->update([
                'status' => 'completed'
            ]);

            return $pengembalian;
        });
    }
}
