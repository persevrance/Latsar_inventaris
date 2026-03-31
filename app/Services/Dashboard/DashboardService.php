<?php

namespace App\Services\Dashboard;

use App\Repositories\BarangRepository;
use App\Repositories\PeminjamanRepository;

class DashboardService
{
    public function __construct(
        protected BarangRepository $barangRepo,
        protected PeminjamanRepository $peminjamanRepo
    ) {}

    public function getAdminDashboard()
    {
        return [
            'total_barang' => $this->barangRepo->getAll()->count(),
            'total_peminjaman' => $this->peminjamanRepo->getAllWithRelation()->count(),
            'pending' => $this->peminjamanRepo->getPending(),
        ];
    }
}
