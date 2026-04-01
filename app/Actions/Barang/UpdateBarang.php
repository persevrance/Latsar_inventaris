<?php

namespace App\Actions\Barang;

use App\Models\Barang;
use App\DTO\Barang\BarangDTO;
use Illuminate\Support\Facades\DB;

class UpdateBarang
{
    public function execute(Barang $barang, BarangDTO $dto): Barang
    {
        return DB::transaction(function () use ($barang, $dto) {

            $barang->update([
                'nama_barang' => $dto->nama_barang,
                'kategori_id' => $dto->kategori_id,
                'lokasi_id' => $dto->lokasi_id,
            ]);

            return $barang;
        });
    }
}
