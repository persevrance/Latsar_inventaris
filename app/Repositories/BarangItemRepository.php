<?php

namespace App\Repositories;

use App\Models\BarangItem;

class BarangItemRepository extends BaseRepository
{
    public function getAll()
    {
        return BarangItem::with(['barang', 'lokasi'])->latest()->get();
    }

    public function getAvailable()
    {
        return BarangItem::where('status', 'tersedia')
            ->with('barang')
            ->get();
    }

    public function getDipinjam()
    {
        return BarangItem::where('status', 'dipinjam')->get();
    }

    public function getByKode($kode)
    {
        return BarangItem::where('kode_item', $kode)
            ->with('barang')
            ->first();
    }

    public function getByBarang($barang_id)
    {
        return BarangItem::where('barang_id', $barang_id)->get();
    }
}
