<?php

namespace App\Exports;

use App\Models\DailyProductionRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class DailyProductionExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DailyProductionRecord::with('kandang')
            ->get()
            ->map(function ($record) {
                return [
                    'Tanggal' => $record->tanggal->format('d M Y'),
                    'Kandang' => $record->kandang?->nama ?? '-',
                    'Umur Ayam' => $record->umur_ayam,
                    'Populasi' => $record->populasi,
                    'Mati' => $record->mati,
                    'Afkir' => $record->afkir,
                    'Pakan (kg)' => $record->pakan_kg,
                    'Telur (Butir)' => $record->telur_butir,
                    'Telur (kg)' => $record->telur_kg,
                    'Telur Retak' => $record->telur_retak,
                    'Telur Kotor' => $record->telur_kotor,
                    'Keterangan' => $record->keterangan,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Tanggal', 'Kandang', 'Umur Ayam', 'Populasi', 'Mati', 'Afkir', 
            'Pakan (kg)', 'Telur (Butir)', 'Telur (kg)', 'Telur Retak', 'Telur Kotor', 'Keterangan'
        ];
    }
}
