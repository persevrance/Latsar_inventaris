<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryBarang extends Model
{
    protected $table = 'history_barang';

    public $timestamps = false;

    protected $fillable = [
        'barang_item_id',
        'tanggal',
        'aktivitas',
        'kondisi_awal',
        'kondisi_akhir',
        'lokasi_awal',
        'lokasi_akhir',
        'user_id',
        'referensi_id',
        'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'datetime'
    ];

    const AKTIVITAS = [
        'PINJAM',
        'KEMBALI',
        'PINDAH_LOKASI',
        'UPDATE_KONDISI'
    ];

    public function barangItem()
    {
        return $this->belongsTo(BarangItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lokasiAwal()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_awal');
    }

    public function lokasiAkhir()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_akhir');
    }
}
