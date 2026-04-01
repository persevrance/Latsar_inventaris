<?php

namespace App\Actions\Barang;

use App\Models\Barang;
use App\Models\BarangItem;
use Illuminate\Support\Facades\DB;

class CreateBarangItem
{
    private function generateKodeItem($barangId): string
    {
        $barang = Barang::findOrFail($barangId);

        $prefix = $barang->kode_barang . '-ITEM-';

        $lastItem = BarangItem::where('barang_id', $barangId)
            ->lockForUpdate()
            ->orderByDesc('kode_item')
            ->first();

        if (!$lastItem) {
            $number = 1;
        } else {
            // ambil angka terakhir setelah ITEM-
            preg_match('/ITEM-(\d+)/', $lastItem->kode_item, $matches);
            $lastNumber = isset($matches[1]) ? (int) $matches[1] : 0;
            $number = $lastNumber + 1;
        }

        return $prefix . str_pad($number, 2, '0', STR_PAD_LEFT);
    }
    public function execute(array $data)
    {
        return DB::transaction(function () use ($data) {

            if (!in_array($data['kondisi'], BarangItem::KONDISI)) {
                throw new \InvalidArgumentException('Kondisi tidak valid');
            }

            $status = BarangItem::mapStatusFromKondisi($data['kondisi']);

            $kodeItem = $this->generateKodeItem($data['barang_id']);

            return BarangItem::create([
                'barang_id' => $data['barang_id'],
                'kode_item' => $kodeItem,
                'kondisi'   => $data['kondisi'],
                'status'    => $status,
            ]);
        });
    }
}
