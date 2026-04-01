<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\Controller;
use App\Models\Peminjaman;
use App\Actions\Peminjaman\ApprovePeminjaman;
use App\Actions\Peminjaman\RejectPeminjaman;

class PeminjamanController extends Controller
{
    public function index()
    {
        return view('pages.admin.peminjaman.index', [
            'data' => Peminjaman::with('details.barangItem')
                ->latest()
                ->get(),
        ]);
    }

    public function approve(Peminjaman $peminjaman, ApprovePeminjaman $action)
    {
        $action->execute($peminjaman, auth()->id());

        return back()->with('success', 'Disetujui');
    }

    public function reject(Peminjaman $peminjaman, RejectPeminjaman $action)
    {
        $action->execute($peminjaman, auth()->id());

        return back()->with('success', 'Ditolak');
    }

    public function show(Peminjaman $peminjaman)
    {
        return view('pages.admin.peminjaman.show', [
            'peminjaman' => $peminjaman->load('details.barangItem.barang', 'user')
        ]);
    }
}
