<?php

namespace App\Repositories;

use App\Models\Barang;

class BarangRepository
{
    public function getAll()
    {
        return Barang::latest()->get();
    }

    public function findById(int $id): Barang
    {
        return Barang::findOrFail($id);
    }

    public function create(array $data): Barang
    {
        return Barang::create($data);
    }

    public function update(Barang $barang, array $data): Barang
    {
        $barang->update($data);
        return $barang;
    }

    public function delete(Barang $barang): void
    {
        $barang->delete();
    }
}
