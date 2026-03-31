<?php

namespace App\Actions\Peminjaman;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class ApprovePeminjaman
{
    public function execute(Peminjaman $peminjaman, int $adminId)
    {
        return DB::transaction(function () use ($peminjaman, $adminId) {

            $peminjaman->update([
                'status' => 'disetujui',
                'approved_by' => $adminId,
            ]);

            foreach ($peminjaman->details as $detail) {
                $detail->barangItem->update([
                    'status' => 'dipinjam'
                ]);
            }

            return $peminjaman;
        });
    }
}
