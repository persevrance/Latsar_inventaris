<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangItem extends Model
{
    protected $table = 'barang_item';

    protected $fillable = [
        'barang_id',
        'kode_item',
        'kondisi',
        'status',
        'lokasi_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function histories()
    {
        return $this->hasMany(HistoryBarang::class);
    }

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    public function detailPengembalian()
    {
        return $this->hasMany(DetailPengembalian::class);
    }

    public function peminjamanAktif()
    {
        return $this->hasOneThrough(
            \App\Models\Peminjaman::class,
            \App\Models\DetailPeminjaman::class,
            'barang_item_id',
            'id',
            'id',
            'peminjaman_id'
        )->where('status', 'active');
    }
}
