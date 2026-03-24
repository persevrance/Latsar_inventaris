<?php

namespace App\Services;

use App\Repositories\BarangItemRepository;

class BarangItemService extends BaseService
{
    protected $repo;

    public function __construct(BarangItemRepository $repo)
    {
        $this->repo = $repo;
    }

    // READ
    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getAvailable()
    {
        return $this->repo->getAvailable();
    }

    public function getByKode($kode)
    {
        return $this->repo->getByKode($kode);
    }

    // WRITE (WAJIB SP)
    public function store(array $data)
    {
        $data['kode_item'] = $this->generateKodeItem($data['barang_id']);

        return \App\Models\BarangItem::create([
            'kode_item' => $data['kode_item'],
            'barang_id' => $data['barang_id'],
            'rak' => $data['rak'] ?? null,
            'status' => 'tersedia',
            'lokasi_id' => null,
        ]);
    }
    public function updateKondisi($id, $kondisi, $keterangan = null)
    {
        return $this->callSP(
            'CALL sp_update_kondisi_barang(?,?,?,?)',
            [
                $id,
                $kondisi,
                auth()->id(),
                $keterangan
            ]
        );
    }

    public function pindahLokasi($id, $lokasi_id)
    {
        return $this->callSP(
            'CALL sp_pindah_lokasi_barang(?,?,?)',
            [
                $id,
                $lokasi_id,
                auth()->id()
            ]
        );
    }

    public function generateKodeItem($barang_id)
    {
        $barang = \App\Models\Barang::findOrFail($barang_id);

        $kodeBarang = $barang->kode_barang;

        // Ambil item terakhir
        $last = \App\Models\BarangItem::where('barang_id', $barang_id)
            ->orderBy('kode_item', 'desc')
            ->first();

        if (!$last) {
            $number = 1;
        } else {
            $lastNumber = (int) substr($last->kode_item, -2);
            $number = $lastNumber + 1;
        }

        return $kodeBarang . '-' . str_pad($number, 2, '0', STR_PAD_LEFT);
    }
}
