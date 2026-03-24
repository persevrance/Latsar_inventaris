<?php

namespace App\Repositories;

use App\Models\BarangItem;
use App\Models\Peminjaman;

class DashboardRepository
{
    public function statsAdmin()
    {
        return [
            'total_barang' => BarangItem::count(),
            'tersedia' => BarangItem::where('status', 'tersedia')->count(),
            'dipinjam' => BarangItem::where('status', 'dipinjam')->count(),
            'maintenance' => BarangItem::where('status', 'maintenance')->count(),
        ];
    }

    public function statsPegawai($user_id)
    {
        return [
            'total_peminjaman' => Peminjaman::where('user_id', $user_id)->count(),
        ];
    }
}
