<?php

namespace App\DTO\Barang;

class BarangItemDTO
{
    public function __construct(
        public int $barang_id,
        public ?string $kode_item = null,
        public ?string $kondisi = 'baik',
        public ?int $lokasi_id = null,

    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            barang_id: $data['barang_id'],
            kode_item: $data['kode_item'] ?? null,
            kondisi: $data['kondisi'] ?? 'baik',
            lokasi_id: $data['lokasi_id'] ?? null,

        );
    }

    public function toArray(): array
    {
        return [
            'barang_id' => $this->barang_id,
            'kode_item' => $this->kode_item,
            'kondisi'   => $this->kondisi,
            'lokasi_id' => $this->lokasi_id,
        ];
    }
}
