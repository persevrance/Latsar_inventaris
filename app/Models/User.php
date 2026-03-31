<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function approvedPeminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'approved_by');
    }

    public function histories()
    {
        return $this->hasMany(HistoryBarang::class);
    }
}
