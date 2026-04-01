<?php

namespace App\Actions\Barang;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use App\DTO\Barang\BarangDTO;

class CreateBarang
{
    private function generateKodeBarang($kategoriId): string
    {
        $kategori = \App\Models\Kategori::findOrFail($kategoriId);

        // ambil 3 huruf awal (uppercase)
        $prefix = strtoupper(substr($kategori->nama_kategori, 0, 3));

        // ambil kode terakhir dengan prefix sama
        $last = Barang::where('kode_barang', 'like', $prefix . '%')
            ->lockForUpdate()
            ->orderByDesc('kode_barang')
            ->first();

        if (!$last) {
            $number = 1;
        } else {
            $lastNumber = (int) substr($last->kode_barang, 3);
            $number = $lastNumber + 1;
        }

        return $prefix . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
    public function execute(BarangDTO $dto): Barang
    {
        return DB::transaction(function () use ($dto) {

            $kodeBarang = $this->generateKodeBarang($dto->kategori_id);

            return Barang::create([
                'kode_barang' => $kodeBarang,
                'nama_barang' => $dto->nama_barang,
                'kategori_id' => $dto->kategori_id,
                'lokasi_id' => $dto->lokasi_id,
            ]);
        });
    }
}
