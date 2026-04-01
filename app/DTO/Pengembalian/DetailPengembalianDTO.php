<?php

namespace App\DTO\Pengembalian;

class DetailPengembalianDTO
{
    public function __construct(
        public int $barang_item_id,
        public string $kondisi,
        public ?string $catatan = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            barang_item_id: $data['barang_item_id'],
            kondisi: $data['kondisi'],
            catatan: $data['catatan'] ?? null
        );
    }
}
