<?php

namespace App\DTO\Peminjaman;

class DetailPeminjamanDTO
{
    public function __construct(
        public int $barang_item_id
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            barang_item_id: $data['barang_item_id']
        );
    }
}
