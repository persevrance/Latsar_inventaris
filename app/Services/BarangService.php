<?php

namespace App\Services;

use App\Repositories\BarangRepository;
use App\Models\Barang;
use App\Models\Kategori;

class BarangService extends BaseService
{
    protected $repo;

    public function __construct(BarangRepository $repo)
    {
        $this->repo = $repo;
    }

    // READ
    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getById($id)
    {
        return $this->repo->getById($id);
    }

    public function search($keyword)
    {
        return $this->repo->search($keyword);
    }

    // WRITE (simple → boleh langsung model)
    public function store($data)
    {
        $data['kode_barang'] = $this->generateKodeBarang($data['kategori_id']);

        return Barang::create($data);
    }

    public function update($id, $data)
    {
        $barang = Barang::findOrFail($id);
        $barang->update($data);

        return $barang;
    }

    public function delete($id)
    {
        return Barang::destroy($id);
    }


    //
    public function generateKodeBarang($kategori_id)
    {
        $kategori = Kategori::findOrFail($kategori_id);

        $prefix = $kategori->prefix;

        // Ambil kode terakhir berdasarkan prefix
        $last = Barang::where('kode_barang', 'like', $prefix . '-%')
            ->orderBy('kode_barang', 'desc')
            ->first();

        if (!$last) {
            $number = 1;
        } else {
            $lastNumber = (int) substr($last->kode_barang, -3);
            $number = $lastNumber + 1;
        }

        return $prefix . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
