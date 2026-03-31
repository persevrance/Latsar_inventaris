<?php

namespace App\Services\Peminjaman;

use App\Actions\Peminjaman\CreatePeminjaman;
use App\Repositories\PeminjamanRepository;
use App\DTO\Peminjaman\PeminjamanDTO;

class PeminjamanService
{
    public function __construct(
        protected CreatePeminjaman $createAction,
        protected PeminjamanRepository $repo
    ) {}

    public function store(PeminjamanDTO $dto)
    {
        return $this->createAction->execute([
            'user_id' => $dto->user_id,
            'items'   => $dto->getItemIds(),
        ]);
    }

    public function getByUser(int $userId)
    {
        return $this->repo->getByUser($userId);
    }

    public function getAll()
    {
        return $this->repo->getAllWithRelation();
    }
}
