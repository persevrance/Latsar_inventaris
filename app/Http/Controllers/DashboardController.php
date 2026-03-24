<?php

namespace App\Http\Controllers;

use App\Models\BarangItem;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard.index', [
            'total_barang' => BarangItem::count(),
            'dipinjam' => BarangItem::where('status', 'dipinjam')->count(),
            'maintenance' => BarangItem::where('status', 'maintenance')->count(),
        ]);
    }

    public function pegawai()
    {
        return view('pegawai.dashboard.index', [
            'peminjaman' => Peminjaman::where('user_id', auth()->id())->count()
        ]);
    }
}
