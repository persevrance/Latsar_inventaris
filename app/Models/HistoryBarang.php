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
        'actor_id',
        'referensi_id',
        'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'datetime'
    ];

    const AKTIVITAS = [
        'PINJAM' => 'dipinjam',
        'KEMBALI' => 'dikembalikan',
        'UPDATE_KONDISI' => 'perubahan_kondisi',
        'PINDAH_LOKASI' => 'dipindahkan',
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

    public function pengembalian()
    {
        return $this->belongsTo(\App\Models\Pengembalian::class, 'referensi_id');
    }
    public function detailPengembalian()
    {
        return $this->hasOne(\App\Models\DetailPengembalian::class, 'pengembalian_id', 'referensi_id')
            ->whereColumn('barang_item_id', 'barang_item_id');
    }

    public function actor()
    {
        return $this->belongsTo(User::class, 'actor_id');
    }
}
