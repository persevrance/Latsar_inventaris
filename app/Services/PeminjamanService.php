<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Peminjaman;

class PeminjamanService extends BaseService
{
    public function create($data)
    {
        DB::beginTransaction();

        try {
            $peminjaman = Peminjaman::create([
                'user_id' => auth()->id(),
                'tanggal_pengajuan' => now(),
                'status' => 'pending'
            ]);

            foreach ($data['barang_item_id'] as $item) {
                $peminjaman->details()->create([
                    'barang_item_id' => $item
                ]);
            }

            DB::commit();
            return $peminjaman;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new \Exception("Gagal membuat peminjaman: " . $e->getMessage());
        }
    }

    public function proses($peminjaman_id)
    {
        return $this->callSP(
            'CALL sp_proses_peminjaman(?,?,?)',
            [
                $peminjaman_id,
                auth()->id(),
                now()->toDateString()
            ]
        );
    }
}
