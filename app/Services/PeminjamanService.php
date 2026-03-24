<?php

namespace App\Services;

use App\Repositories\PeminjamanRepository;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class PeminjamanService extends BaseService
{
    protected $repo;

    public function __construct(PeminjamanRepository $repo)
    {
        $this->repo = $repo;
    }

    // ================= READ =================

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getByUser()
    {
        return $this->repo->getByUser(auth()->id());
    }

    public function getById($id)
    {
        return $this->repo->getById($id);
    }

    public function getPending()
    {
        return $this->repo->getPending();
    }

    // ================= WRITE =================

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
            throw new \Exception($e->getMessage());
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
