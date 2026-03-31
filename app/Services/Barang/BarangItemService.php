<?php

namespace App\Services\Barang;

use App\Actions\Barang\CreateBarangItem;
use App\Actions\Barang\UpdateBarangItem;
use App\Repositories\BarangItemRepository;
use App\DTO\Barang\BarangItemDTO;

class BarangItemService
{
    public function __construct(
        protected BarangItemRepository $repo,
        protected CreateBarangItem $createAction,
        protected UpdateBarangItem $updateAction,
    ) {}

    public function store(BarangItemDTO $dto)
    {
        return $this->createAction->execute($dto->toArray());
    }

    public function update(int $id, BarangItemDTO $dto)
    {
        $item = $this->repo->findById($id);

        return $this->updateAction->execute($item, $dto->toArray());
    }

    public function delete(int $id)
    {
        $item = $this->repo->findById($id);

        $this->repo->delete($item);
    }
}
