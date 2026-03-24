<?php

namespace App\Services;

use App\Models\Barang;

class BarangService extends BaseService
{
    public function store($data)
    {
        return Barang::create($data);
    }

    public function update($id, $data)
    {
        $barang = Barang::findOrFail($id);
        $barang->update($data);

        return $barang;
    }

    public function delete($id)
    {
        return Barang::destroy($id);
    }
}
