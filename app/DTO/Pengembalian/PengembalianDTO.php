<?php

namespace App\DTO\Pengembalian;

class PengembalianDTO
{
    /**
     * @param DetailPengembalianDTO[] $items
     */
    public function __construct(
        public int $peminjaman_id,
        public array $items
    ) {}

    public static function fromArray(array $data): self
    {
        $items = [];

        foreach ($data['items'] as $itemId => $kondisi) {
            $items[] = new DetailPengembalianDTO(
                barang_item_id: $itemId,
                kondisi: $kondisi,
                catatan: $data['catatan'][$itemId] ?? null
            );
        }

        return new self(
            peminjaman_id: $data['peminjaman_id'],
            items: $items
        );
    }

    public function toKeyValue(): array
    {
        $result = [];

        foreach ($this->items as $item) {
            $result[$item->barang_item_id] = $item->kondisi;
        }

        return $result;
    }
}
