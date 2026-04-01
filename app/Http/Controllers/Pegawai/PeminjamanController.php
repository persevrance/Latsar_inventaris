<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Base\Controller;
use App\DTO\Peminjaman\PeminjamanDTO;
use App\Actions\Peminjaman\CreatePeminjaman;
use App\Models\Barang;
use App\Models\BarangItem;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with([
            'details.barangItem.barang'
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pages.pegawai.peminjaman.index', compact('data'));
    }
    public function store(Request $request, CreatePeminjaman $action)
    {
        $request->validate([
            'item_id' => 'required|exists:barang_item,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali_rencana' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $dto = PeminjamanDTO::fromArray([
            'user_id' => auth()->id(),
            'items' => [$request->item_id],
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
            'keterangan' => $request->keterangan,
        ]);

        $action->execute($dto);

        return back()->with('success', 'Pengajuan berhasil');
    }

    public function create()
    {
        $barangs = Barang::all();

        return view('pages.pegawai.peminjaman.create', compact('barangs'));
    }

    public function getItems($id)
    {
        $items = BarangItem::where('barang_id', $id)
            ->where('status', 'tersedia')
            ->get(['id', 'kode_item']);

        return response()->json($items);
    }
}
