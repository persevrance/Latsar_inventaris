<?php

namespace App\Actions\Barang;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Exception;

class DeleteBarang
{
    public function execute(Barang $barang): void
    {
        DB::transaction(function () use ($barang) {

            // Rule: tidak boleh hapus jika masih punya item
            if ($barang->items()->exists()) {
                throw new Exception('Barang masih memiliki item');
            }

            $barang->delete();
        });
    }
}
