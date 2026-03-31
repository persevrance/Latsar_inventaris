<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Base\Controller;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pegawai.dashboard', [
            'peminjaman' => Peminjaman::where('user_id', auth()->id())->latest()->get()
        ]);
    }
}
