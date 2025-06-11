<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kandang extends Model
{
    protected $fillable = [
        'nama',
        'populasi_awal',
        'tanggal_mulai',
        'umur_awal',
    ];

    public function produksi()
    {
        return $this->hasMany(DailyProductionRecord::class);
    }

}
