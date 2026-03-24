<?php

namespace App\Repositories;

use App\Models\Peminjaman;

class PeminjamanRepository extends BaseRepository
{
    public function getAll()
    {
        return Peminjaman::with(['user', 'details.barangItem'])
            ->latest()
            ->get();
    }

    public function getByUser($user_id)
    {
        return Peminjaman::where('user_id', $user_id)
            ->with('details.barangItem')
            ->latest()
            ->get();
    }

    public function getPending()
    {
        return Peminjaman::where('status', 'pending')->get();
    }

    public function getActive()
    {
        return Peminjaman::where('status', 'active')->get();
    }

    public function getById($id)
    {
        return Peminjaman::with(['details.barangItem', 'user'])
            ->findOrFail($id);
    }
}
