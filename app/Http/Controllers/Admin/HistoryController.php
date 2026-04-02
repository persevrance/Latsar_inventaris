<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\Controller;
use App\Models\HistoryBarang;
use App\Models\Barang;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = HistoryBarang::with([
            'barangItem.barang',
            'user',
            'actor',
            'lokasiAwal',
            'lokasiAkhir',
            'detailPengembalian'
        ])->latest('tanggal');


        // FILTER
        if ($request->filled('aktivitas')) {
            $query->where('aktivitas', $request->aktivitas);
        }

        if ($request->filled('barang_id')) {
            $query->whereHas('barangItem', function ($q) use ($request) {
                $q->where('barang_id', $request->barang_id);
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        return view('pages.admin.history.index', [
            'histories' => $query->paginate(10),
            'barangs' => Barang::all()
        ]);
    }

    public function show(Barang $barang)
    {
        $histories = HistoryBarang::with(['barangItem', 'user', 'actor'])
            ->whereHas('barangItem', function ($q) use ($barang) {
                $q->where('barang_id', $barang->id);
            })
            ->latest()
            ->paginate(10);

        return view('pages.admin.history.show', [
            'barang' => $barang,
            'histories' => $histories
        ]);
    }
}
