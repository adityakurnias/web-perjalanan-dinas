<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPerjalanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'sppd_id',
        'kegiatan',
        'hasil',
        'total_biaya',
    ];

    public function sppd()
    {
        return $this->belongsTo(SPPD::class);
    }

    public function biayas()
    {
        return $this->hasMany(Biaya::class, 'laporan_id');
    }
}