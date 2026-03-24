<?php

namespace App\Repositories;

use App\Models\Pengembalian;

class PengembalianRepository extends BaseRepository
{
    public function getAll()
    {
        return Pengembalian::with(['peminjaman.user', 'details.barangItem'])
            ->latest()
            ->get();
    }

    public function getByPeminjaman($peminjaman_id)
    {
        return Pengembalian::where('peminjaman_id', $peminjaman_id)
            ->with('details')
            ->first();
    }
}
