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
    public function store($data)
    {
        return $this->callSP(
            'CALL sp_tambah_barang_item(?,?,?,?)',
            [
                $data['barang_id'],
                $data['kode_item'],
                $data['lokasi_id'],
                auth()->id()
            ]
        );
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
}
