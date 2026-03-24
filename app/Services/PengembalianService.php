<?php

namespace App\Services;

use App\Repositories\PengembalianRepository;

class PengembalianService extends BaseService
{
    protected $repo;

    public function __construct(PengembalianRepository $repo)
    {
        $this->repo = $repo;
    }

    // READ
    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getByPeminjaman($id)
    {
        return $this->repo->getByPeminjaman($id);
    }

    // WRITE (SP)
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
