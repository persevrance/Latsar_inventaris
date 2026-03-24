<?php

namespace App\Services;

use App\Models\BarangItem;
use App\Models\Peminjaman;

class DashboardService
{
    public function adminStats()
    {
        return [
            'total_barang' => BarangItem::count(),
            'tersedia' => BarangItem::where('status', 'tersedia')->count(),
            'dipinjam' => BarangItem::where('status', 'dipinjam')->count(),
            'maintenance' => BarangItem::where('status', 'maintenance')->count(),
        ];
    }

    public function pegawaiStats()
    {
        return [
            'total_peminjaman' => Peminjaman::where('user_id', auth()->id())->count()
        ];
    }
}
