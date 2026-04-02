<?php

namespace App\Actions\Barang;

use App\Models\BarangItem;
use Illuminate\Support\Facades\DB;
use App\Actions\History\CreateHistoryBarang;


class UpdateBarangItem
{
    protected $history;

    public function __construct(CreateHistoryBarang $history)
    {
        $this->history = $history;
    }
    public function execute(BarangItem $item, array $data)
    {
        if (!in_array($data['kondisi'], BarangItem::KONDISI)) {
            throw new \InvalidArgumentException('Kondisi tidak valid');
        }

        $oldKondisi = $item->kondisi;
        $oldLokasi = $item->lokasi_id;

        $status = BarangItem::mapStatusFromKondisi($data['kondisi']);

        $item->update([
            'kode_item' => $data['kode_item'] ?? $item->kode_item,
            'kondisi'   => $data['kondisi'],
            'status'    => $status,
        ]);

        // HISTORY
        $this->history->execute([
            'barang_item_id' => $item->id,
            'aktivitas' => 'UPDATE_KONDISI',
            'kondisi_awal' => $oldKondisi,
            'kondisi_akhir' => $item->kondisi,
            'lokasi_awal' => $oldLokasi,
            'lokasi_akhir' => $item->lokasi_id,
            'keterangan' => 'Update manual oleh admin'
        ]);

        return $item;
    }
}
