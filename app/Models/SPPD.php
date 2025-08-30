<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPPD extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tujuan',
        'tanggal_berangkat',
        'tanggal_kembali',
        'keperluan',
        'status',
        'catatan_admin',
    ];

    protected $casts = [
        'tanggal_berangkat' => 'date',
        'tanggal_kembali' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laporan()
    {
        return $this->hasOne(LaporanPerjalanan::class, 'sppd_id');
    }

    public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case 'approved':
                return 'green';
            case 'rejected':
                return 'red';
            default:
                return 'orange';
        }
    }
}