<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangItem extends Model
{
    use SoftDeletes;

    protected $table = 'barang_item';

    protected $fillable = [
        'barang_id',
        'kode_item',
        'kondisi',
        'lokasi_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // DOMAIN CONSTANT
    const KONDISI = ['baik', 'rusak', 'hilang'];

    const STATUS = ['tersedia', 'dipinjam', 'maintenance', 'nonaktif'];

    // MAPPING LOGIC (IMPORTANT)
    public static function mapStatusFromKondisi($kondisi)
    {
        return match ($kondisi) {
            'baik' => 'tersedia',
            'rusak' => 'maintenance',
            'hilang' => 'nonaktif',
            default => 'tersedia'
        };
    }

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
}
