<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'tanggal_pengajuan',
        'tanggal_pinjam',
        'tanggal_kembali_rencana',
        'status',
        'approved_by',
        'approved_at',
        'keterangan',
        'updated_at'
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
        'tanggal_pinjam' => 'date',
        'tanggal_kembali_rencana' => 'date',
        'approved_at' => 'datetime',
    ];

    protected $with = ['user']; // optimization

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function details()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }
}
