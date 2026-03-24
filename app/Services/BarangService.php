<?php

namespace App\Services;

use App\Repositories\BarangRepository;
use App\Models\Barang;

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
}
