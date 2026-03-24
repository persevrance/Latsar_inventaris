<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanRequest;
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
        try {
            $this->service->proses($id);
            return redirect()
                ->back()
                ->with('success', 'Peminjaman berhasil diproses');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
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

    public function store(PeminjamanRequest $request)
    {
        try {
            $data = $request->validated();

            $this->service->create($data);

            return redirect()
                ->route('pegawai.peminjaman')
                ->with('success', 'Pengajuan peminjaman berhasil');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}
