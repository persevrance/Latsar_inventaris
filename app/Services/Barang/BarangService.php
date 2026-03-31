<?php

namespace App\Services\Barang;

use App\Repositories\BarangRepository;
use App\DTO\Barang\BarangDTO;

class BarangService
{
    public function __construct(
        protected BarangRepository $repo
    ) {}

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function store(BarangDTO $dto)
    {
        return $this->repo->create((array) $dto);
    }

    public function update(int $id, BarangDTO $dto)
    {
        $barang = $this->repo->findById($id);

        return $this->repo->update($barang, (array) $dto);
    }

    public function delete(int $id)
    {
        $barang = $this->repo->findById($id);

        $this->repo->delete($barang);
    }
}
