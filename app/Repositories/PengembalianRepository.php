<?php

namespace App\Repositories;

use App\Models\Pengembalian;

class PengembalianRepository
{
    public function create(array $data): Pengembalian
    {
        return Pengembalian::create($data);
    }

    public function findById(int $id): Pengembalian
    {
        return Pengembalian::findOrFail($id);
    }
}
