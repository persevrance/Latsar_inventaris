<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    protected $repo;

    public function __construct(DashboardRepository $repo)
    {
        $this->repo = $repo;
    }

    public function adminStats()
    {
        return $this->repo->statsAdmin();
    }

    public function pegawaiStats()
    {
        return $this->repo->statsPegawai(auth()->id());
    }
}
