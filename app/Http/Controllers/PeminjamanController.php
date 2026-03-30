<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{

    /* ADMIN */
    // LIST
    public function index()
    {
        $data = Peminjaman::with('user')
            ->orderByRaw("FIELD(status, 'pending') DESC")
            ->orderBy('tanggal_pengajuan', 'desc')
            ->get();

        return view('admin.peminjaman.index', compact('data'));
    }

    // DETAIL
    public function show($id)
    {
        $data = Peminjaman::with([
            'details.barangItem',
            'user',
            'approver'
        ])->findOrFail($id);

        return view('admin.peminjaman.show', compact('data'));
    }

    public function decline($id)
    {
        DB::beginTransaction();

        try {
            $peminjaman = Peminjaman::findOrFail($id);

            if ($peminjaman->status !== 'pending') {
                DB::rollBack();
                return back()->with('error', 'Status tidak valid');
            }

            $peminjaman->update([
                'status' => 'rejected',
                'approved_by' => auth()->id(),
                'approved_at' => now()
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan');
        }

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman ditolak');
    }

    // PROSES
    public function proses($id)
    {
        DB::beginTransaction();

        try {
            $peminjaman = Peminjaman::with('details.barangItem')->findOrFail($id);

            if ($peminjaman->status !== 'pending') {
                DB::rollBack();
                return back()->with('error', 'Status tidak valid');
            }

            // VALIDASI ULANG
            foreach ($peminjaman->details as $detail) {
                if ($detail->barangItem->status !== 'tersedia') {
                    DB::rollBack();
                    return back()->with('error', 'Barang sudah tidak tersedia');
                }
            }

            $peminjaman->update([
                'status' => 'approved',
                'approved_by' => auth()->id(),
                'approved_at' => now()
            ]);

            foreach ($peminjaman->details as $detail) {
                $detail->barangItem->update([
                    'status' => 'dipinjam'
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan');
        }

        return redirect('/admin/peminjaman')
            ->with('success', 'Peminjaman diproses');
    }


    /* PEGAWAI */
    public function indexPegawai()
    {
        $userId = auth()->id();

        $data = Peminjaman::with(['details.barangItem'])
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();

        return view('pegawai.peminjaman.index', compact('data'));
    }

    public function create()
    {

        $barang = \App\Models\BarangItem::with([
            'barang.kategori',
            'barang.lokasi'
        ])
            ->where('status', 'tersedia')
            ->get();

        return view('pegawai.peminjaman.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_item_id' => 'required|array|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali_rencana' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        DB::beginTransaction();

        try {
            $validItems = \App\Models\BarangItem::whereIn('id', $request->barang_item_id)
                ->where('status', 'tersedia')
                ->lockForUpdate()
                ->pluck('id')
                ->toArray();

            if (count($validItems) !== count($request->barang_item_id)) {
                DB::rollBack();
                return back()->with('error', 'Ada barang yang sudah tidak tersedia');
            }

            $peminjaman = Peminjaman::create([
                'user_id' => auth()->id(),
                'tanggal_pengajuan' => now(),
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
                'status' => 'pending',
                'keterangan' => $request->keterangan
            ]);

            foreach ($request->barang_item_id as $barangId) {
                \App\Models\DetailPeminjaman::create([
                    'peminjaman_id' => $peminjaman->id,
                    'barang_item_id' => $barangId
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan');
        }

        return redirect('/pegawai/peminjaman')
            ->with('success', 'Pengajuan berhasil dikirim');
    }
}
