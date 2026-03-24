<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\BarangItem;
use App\Services\PeminjamanService;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    protected $service;

    public function __construct(PeminjamanService $service)
    {
        $this->service = $service;
    }

    // ================= ADMIN =================
    public function index()
    {
        $data = Peminjaman::with('user')->get();
        return view('admin.peminjaman.index', compact('data'));
    }

    public function verifikasi($id)
    {
        $data = Peminjaman::with('details.barangItem')->findOrFail($id);
        return view('admin.peminjaman.verifikasi', compact('data'));
    }

    public function proses($id)
    {
        $this->service->proses($id);

        return back()->with('success', 'Peminjaman diproses');
    }

    // ================= PEGAWAI =================
    public function indexPegawai()
    {
        $data = Peminjaman::where('user_id', auth()->id())->get();
        return view('pegawai.peminjaman.index', compact('data'));
    }

    public function create()
    {
        $barang = BarangItem::where('status', 'tersedia')->get();

        return view('pegawai.peminjaman.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $peminjaman = Peminjaman::create([
            'user_id' => auth()->id(),
            'tanggal_pengajuan' => now(),
            'status' => 'pending'
        ]);

        foreach ($request->barang_item_id as $item) {
            $peminjaman->details()->create([
                'barang_item_id' => $item
            ]);
        }

        return redirect()->back()->with('success', 'Pengajuan berhasil');
    }
}
