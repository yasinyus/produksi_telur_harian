<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyProductionRecord extends Model
{
    protected $casts = [
        'tanggal' => 'date',
    ];
    
    protected $fillable = [
        'tanggal',
        'umur_ayam',
        'populasi',
        'mati',
        'afkir',
        'pakan_kg',
        'telur_butir',
        'telur_kg',
        'telur_retak',
        'telur_kotor',
        'keterangan'
    ];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class);
    }

}
