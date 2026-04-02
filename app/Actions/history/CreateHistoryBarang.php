<?php

namespace App\Actions\History;

use App\Models\HistoryBarang;

class CreateHistoryBarang
{
    public function execute(array $data)
    {
        $validAktivitas = [
            'dibuat',
            'dipinjam',
            'dikembalikan',
            'perubahan_kondisi',
            'dipindahkan',
            'maintenance'
        ];

        // VALIDASI
        if (!in_array($data['aktivitas'], $validAktivitas)) {
            throw new \Exception("Aktivitas tidak valid: " . $data['aktivitas']);
        }


        return HistoryBarang::create([
            'barang_item_id' => $data['barang_item_id'],
            'tanggal' => now(),
            'aktivitas' => $data['aktivitas'],
            'kondisi_awal' => $data['kondisi_awal'] ?? null,
            'kondisi_akhir' => $data['kondisi_akhir'] ?? null,
            'lokasi_awal' => $data['lokasi_awal'] ?? null,
            'lokasi_akhir' => $data['lokasi_akhir'] ?? null,
            'user_id' => $data['user_id'],
            'actor_id' => $data['actor_id'] ?? auth()->id(),
            'referensi_id' => $data['referensi_id'] ?? null,
            'keterangan' => $data['keterangan'] ?? null,
        ]);
    }
}
