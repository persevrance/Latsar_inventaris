<?php

namespace App\Http\Controllers\Admin;

use App\Actions\History\CreateHistoryBarang;
use App\Http\Controllers\Base\Controller;
use App\Models\Peminjaman;
use App\Actions\Peminjaman\ApprovePeminjaman;
use App\Actions\Peminjaman\RejectPeminjaman;
use App\Models\HistoryBarang;

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

    public function approve(
        Peminjaman $peminjaman,
        ApprovePeminjaman $action,
        CreateHistoryBarang $createHistoryBarang
    ) {
        $action->execute($peminjaman, auth()->id());

        foreach ($peminjaman->details as $detail) {
            $item = $detail->barangItem;

            $createHistoryBarang->execute([
                'barang_item_id' => $item->id,
                'aktivitas' => HistoryBarang::AKTIVITAS['PINJAM'],
                'kondisi_awal' => $item->kondisi,
                'kondisi_akhir' => $item->kondisi,
                'lokasi_awal' => $item->lokasi_id,
                'lokasi_akhir' => null,
                'user_id' => $peminjaman->user_id,
                'actor_id' => auth()->id(),
                'referensi_id' => $peminjaman->id,
                'keterangan' => 'Disetujui admin'
            ]);
        }

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
