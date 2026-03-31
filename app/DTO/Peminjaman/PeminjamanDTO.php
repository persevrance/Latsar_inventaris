<?php

namespace App\DTO\Peminjaman;

class PeminjamanDTO
{
    /**
     * @param DetailPeminjamanDTO[] $items
     */
    public function __construct(
        public int $user_id,
        public array $items
    ) {}

    public static function fromArray(array $data): self
    {
        $items = array_map(
            fn($item) => DetailPeminjamanDTO::fromArray([
                'barang_item_id' => $item
            ]),
            $data['items']
        );

        return new self(
            user_id: $data['user_id'],
            items: $items
        );
    }

    public function getItemIds(): array
    {
        return array_map(
            fn($item) => $item->barang_item_id,
            $this->items
        );
    }
}
