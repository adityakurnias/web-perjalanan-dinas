<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_id',
        'jenis_biaya',
        'jumlah',
        'keterangan',
        'status',
    ];

    public function laporan()
    {
        return $this->belongsTo(LaporanPerjalanan::class, 'laporan_id');
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