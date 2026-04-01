<?php

namespace App\Actions\Peminjaman;

use App\Models\Peminjaman;

class RejectPeminjaman
{
    public function execute(Peminjaman $peminjaman, int $adminId)
    {
        $peminjaman->update([
            'status' => 'rejected',
            'approved_by' => $adminId,
        ]);

        return $peminjaman;
    }
}
