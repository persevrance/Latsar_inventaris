<?php

namespace App\Repositories;

use App\Models\Peminjaman;

class PeminjamanRepository
{
    public function getAllWithRelation()
    {
        return Peminjaman::with('details.barangItem')
            ->latest()
            ->get();
    }

    public function findById(int $id): Peminjaman
    {
        return Peminjaman::with('details.barangItem')
            ->findOrFail($id);
    }

    public function create(array $data): Peminjaman
    {
        return Peminjaman::create($data);
    }

    public function update(Peminjaman $peminjaman, array $data): Peminjaman
    {
        $peminjaman->update($data);
        return $peminjaman;
    }

    public function getByUser(int $userId)
    {
        return Peminjaman::where('user_id', $userId)
            ->latest()
            ->get();
    }

    public function getPending()
    {
        return Peminjaman::where('status', 'pending')->count();
    }
}
