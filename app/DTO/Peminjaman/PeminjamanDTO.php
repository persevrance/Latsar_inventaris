<?php

namespace App\DTO\Peminjaman;

class PeminjamanDTO
{
    /**
     * @param DetailPeminjamanDTO[] $items
     */
    public function __construct(
        public int $user_id,
        public array $items,
        public ?string $tanggal_pinjam,
        public ?string $tanggal_kembali_rencana,
        public ?string $keterangan
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
            items: $items,
            tanggal_pinjam: $data['tanggal_pinjam'] ?? null,
            tanggal_kembali_rencana: $data['tanggal_kembali_rencana'] ?? null,
            keterangan: $data['keterangan'] ?? null,
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
