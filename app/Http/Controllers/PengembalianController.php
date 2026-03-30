<?php

namespace App\Http\Controllers;

use App\Models\DetailPengembalian;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Services\PengembalianService;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    protected $service;

    public function __construct(PengembalianService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = Peminjaman::with([
            'user',
            'details.barangItem.barang',
        ])
            ->where('status', 'approved')
            ->get();

        return view('admin.pengembalian.index', compact('data'));
    }

    public function proses($id)
    {
        $peminjaman = Peminjaman::with('details')->findOrFail($id);

        if ($peminjaman->status !== 'approved') {
            return back()->with('error', 'Status tidak valid');
        }

        // simpan pengembalian
        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_kembali' => now(),
            'diterima_by' => auth()->id(),
        ]);



        // copy detail dari peminjaman
        foreach ($peminjaman->details as $detail) {
            DetailPengembalian::create([
                'pengembalian_id' => $pengembalian->id,
                'barang_item_id' => $detail->barang_item_id,
                'kondisi_kembali' => 'baik' // default dulu
            ]);
        }

        // update status
        $peminjaman->update([
            'status' => 'completed'
        ]);


        return redirect('/admin/peminjaman')
            ->with('success', 'Barang berhasil dikembalikan');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with([
            'user',
            'pengembalian.penerima',
            'pengembalian.details.barangItem.barang'
        ])->findOrFail($id);

        // guard: harus sudah completed & ada data pengembalian
        if ($peminjaman->status !== 'completed' || !$peminjaman->pengembalian) {
            return back()->with('error', 'Data pengembalian tidak tersedia');
        }

        return view('admin.pengembalian.show', compact('peminjaman'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'kondisi' => 'required',
            'catatan' => 'nullable'
        ]);

        $peminjaman = Peminjaman::with('details.barangItem')->findOrFail($id);

        // simpan pengembalian
        Pengembalian::create([
            'peminjaman_id' => $id,
            'tanggal_kembali' => now(),
            'kondisi' => $request->kondisi,
            'catatan' => $request->catatan
        ]);

        // update status
        $peminjaman->update([
            'status' => 'completed'
        ]);

        // update kondisi barang + stok
        foreach ($peminjaman->details as $detail) {
            $barang = $detail->barangItem;

            $barang->increment('stok');

            // optional: simpan kondisi terakhir
            $barang->update([
                'kondisi' => $request->kondisi
            ]);
        }

        return back()->with('success', 'Pengembalian berhasil');
    }
}
