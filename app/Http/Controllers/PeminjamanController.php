<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
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

    // PROSES
    public function proses($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // guard sederhana
        if ($peminjaman->status !== 'pending') {
            return back()->with('error', 'Status tidak valid');
        }

        $peminjaman->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now()
        ]);

        return redirect('/admin/peminjaman')
            ->with('success', 'Peminjaman diproses');
    }
}
