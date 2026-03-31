<?php

namespace App\Actions\Peminjaman;

use App\Models\Peminjaman;

class ReturnPeminjaman
{
    public function execute(Peminjaman $peminjaman)
    {
        $peminjaman->update([
            'status' => 'dikembalikan'
        ]);

        return $peminjaman;
    }
}
