<?php

namespace App\DTO\Barang;

class UpdateBarangDTO
{
    public function __construct(
        public string $nama_barang,
        public ?string $deskripsi,
        public int $kategori_id,
        public int $lokasi_id,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            nama_barang: $data['nama_barang'],
            deskripsi: $data['deskripsi'] ?? null,
            kategori_id: $data['kategori_id'],
            lokasi_id: $data['lokasi_id'],
        );
    }

    public static function fromRequest($request): self
    {
        return self::fromArray($request->validated());
    }
}
