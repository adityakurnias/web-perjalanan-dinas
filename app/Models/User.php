<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nik',
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class);
    }

    public function sppds()
    {
        return $this->hasMany(SPPD::class);
    }

    public function laporans()
    {
        return $this->hasMany(LaporanPerjalanan::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }
}