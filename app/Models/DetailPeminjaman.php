<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $table = 'detail_peminjaman';

    public $timestamps = false;

    protected $fillable = [
        'peminjaman_id',
        'barang_item_id'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function barangItem()
    {
        return $this->belongsTo(BarangItem::class);
    }

    public function pengembalianDetail()
    {
        return $this->hasOne(
            DetailPengembalian::class,
            'barang_item_id',
            'barang_item_id'
        );
    }
}
