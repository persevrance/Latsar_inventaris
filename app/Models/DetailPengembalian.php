<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPengembalian extends Model
{
    protected $table = 'detail_pengembalian';

    public $timestamps = false;

    protected $fillable = [
        'pengembalian_id',
        'barang_item_id',
        'kondisi_kembali',
        'catatan'
    ];

    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class);
    }

    public function barangItem()
    {
        return $this->belongsTo(BarangItem::class, 'barang_item_id', 'id');
    }
}
