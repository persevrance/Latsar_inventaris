<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangItem;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function barang()
    {
        $data = BarangItem::with([
            'barang.kategori',
            'lokasi',
            'detailPeminjaman.peminjaman'
        ])->get();

        return view('admin.laporan.barang', compact('data'));
    }

    public function peminjaman(Request $request)
    {
        $query = Peminjaman::with(['user', 'details.barangItem']);

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal_pinjam', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $data = $query->get();

        return view('admin.laporan.peminjaman', compact('data'));
    }

    public function pengembalian(Request $request)
    {
        $query = Pengembalian::with(['peminjaman.user', 'details.barangItem']);

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal_kembali', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $data = $query->get();

        return view('admin.laporan.pengembalian', compact('data'));
    }

    public function gabungan(Request $request)
    {
        $query = \App\Models\DetailPeminjaman::with([
            'peminjaman.user',
            'barangItem',
            'pengembalianDetail.pengembalian'
        ]);

        // filter tanggal pinjam
        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereHas('peminjaman', function ($q) use ($request) {
                $q->whereBetween('tanggal_pinjam', [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]);
            });
        }

        $data = $query->get();

        return view('admin.laporan.gabungan', compact('data'));
    }
}
