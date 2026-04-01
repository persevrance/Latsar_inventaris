<?php

namespace App\Actions\Peminjaman;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class ApprovePeminjaman
{
    public function execute(Peminjaman $peminjaman, int $adminId)
    {
        return DB::transaction(function () use ($peminjaman, $adminId) {

            // reload dengan relasi lengkap
            $peminjaman = Peminjaman::with('details.barangItem')
                ->findOrFail($peminjaman->id);

            // guard
            if ($peminjaman->status !== 'pending') {
                throw new \Exception('Status tidak valid');
            }

            // update peminjaman
            $peminjaman->update([
                'status' => 'active',
                'approved_by' => $adminId,
                'tanggal_pinjam' => now(),
            ]);

            // update semua barang item
            foreach ($peminjaman->details as $detail) {

                $item = $detail->barangItem;

                if (!$item) {
                    throw new \Exception("Barang item tidak ditemukan");
                }

                if ($item->kondisi === 'hilang') {
                    throw new \Exception("Barang hilang tidak bisa dipinjam");
                }

                if ($item->status !== 'tersedia') {
                    throw new \Exception("Barang tidak tersedia");
                }

                $item->update([
                    'status' => 'dipinjam'
                ]);
            }

            return $peminjaman;
        });
    }
}
