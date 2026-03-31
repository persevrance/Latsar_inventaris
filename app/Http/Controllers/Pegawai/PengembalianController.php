<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Base\Controller;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function index()
    {
        return view('pegawai.pengembalian.index', [
            'data' => Peminjaman::where('user_id', auth()->id())
                ->where('status', 'disetujui')
                ->get()
        ]);
    }
}
