<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\Controller;
use App\Models\Barang;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.admin.dashboard.index', [
            'total_barang' => Barang::count(),
            'total_peminjaman' => Peminjaman::count(),
            'pending' => Peminjaman::where('status', 'pending')->count(),
        ]);
    }
}
