<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class PengembalianService extends BaseService
{
    public function proses($peminjaman_id)
    {
        return $this->callSP(
            'CALL sp_pengembalian_barang(?,?)',
            [
                $peminjaman_id,
                auth()->id()
            ]
        );
    }
}
