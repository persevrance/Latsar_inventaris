<?php

namespace App\Services\Peminjaman;

use App\Actions\Peminjaman\ApprovePeminjaman;
use App\Actions\Peminjaman\RejectPeminjaman;
use App\Repositories\PeminjamanRepository;

class PeminjamanApprovalService
{
    public function __construct(
        protected ApprovePeminjaman $approveAction,
        protected RejectPeminjaman $rejectAction,
        protected PeminjamanRepository $repo
    ) {}

    public function approve(int $id, int $adminId)
    {
        $peminjaman = $this->repo->findById($id);

        return $this->approveAction->execute($peminjaman, $adminId);
    }

    public function reject(int $id, int $adminId)
    {
        $peminjaman = $this->repo->findById($id);

        return $this->rejectAction->execute($peminjaman, $adminId);
    }
}
