<?php

namespace App\DTO\Barang;

class BarangItemDTO
{
    public function __construct(
        public int $barang_id,
        public string $kode_item,
        public ?string $kondisi = 'baik',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            barang_id: $data['barang_id'],
            kode_item: $data['kode_item'],
            kondisi: $data['kondisi'] ?? 'baik',
        );
    }

    public function toArray(): array
    {
        return [
            'barang_id' => $this->barang_id,
            'kode_item' => $this->kode_item,
            'kondisi'   => $this->kondisi,
        ];
    }
}
