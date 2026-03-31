<?php

namespace App\Services\Pengembalian;

use App\Actions\Pengembalian\ProcessPengembalian;
use App\Repositories\PeminjamanRepository;
use App\DTO\Pengembalian\PengembalianDTO;

class PengembalianService
{
    public function __construct(
        protected ProcessPengembalian $processAction,
        protected PeminjamanRepository $peminjamanRepo
    ) {}

    public function process(PengembalianDTO $dto)
    {
        $peminjaman = $this->peminjamanRepo->findById($dto->peminjaman_id);

        return $this->processAction->execute(
            $peminjaman,
            $dto->toKeyValue()
        );
    }
}
