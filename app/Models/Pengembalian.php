<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';

    protected $fillable = [
        'peminjaman_id',
        'tanggal_kembali',
        'diterima_by'
    ];

    protected $casts = [
        'tanggal_kembali' => 'date',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function details()
    {
        return $this->hasMany(DetailPengembalian::class);
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'diterima_by');
    }
}
