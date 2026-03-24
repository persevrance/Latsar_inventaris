<?php

namespace App\Repositories;

use App\Models\Barang;

class BarangRepository extends BaseRepository
{
    public function getAll()
    {
        return Barang::with(['kategori', 'lokasi'])->latest()->get();
    }

    public function getById($id)
    {
        return Barang::with(['kategori', 'lokasi'])->findOrFail($id);
    }

    public function search($keyword)
    {
        return Barang::where('nama_barang', 'like', "%$keyword%")
            ->orWhere('kode_barang', 'like', "%$keyword%")
            ->get();
    }
}
