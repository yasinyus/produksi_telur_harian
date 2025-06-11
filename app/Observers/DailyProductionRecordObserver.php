<?php

namespace App\Observers;

use App\Models\DailyProductionRecord;
use App\Models\Kandang;
use Carbon\Carbon;

class DailyProductionRecordObserver
{
    public function saving(DailyProductionRecord $record): void
    {
    

            

        // Hitung umur otomatis dari tanggal_mulai dan umur_awal kandang
        if ($record->kandang_id && $record->tanggal) {
            $kandang = \App\Models\Kandang::find($record->kandang_id);

            // Cek record sebelumnya
            $prev = DailyProductionRecord::where('kandang_id', $record->kandang_id)
                ->where('tanggal', '<', $record->tanggal)
                ->orderBy('tanggal', 'desc')
                ->first();

            if ($prev) {
                $record->populasi = $prev->populasi - ($prev->mati + $prev->afkir);
            } elseif ($kandang) {
                $record->populasi = $kandang->populasi_awal;
            }
            if ($kandang && $kandang->tanggal_mulai) {
                $tanggalMulai = Carbon::parse($kandang->tanggal_mulai);
                $selisihHari = Carbon::parse($kandang->tanggal_mulai)->diffInDays($record->tanggal);
                $record->umur_ayam = $kandang->umur_awal + $selisihHari;
            }
        }

        // Perhitungan lainnya
        $record->total_mati_afkir = $record->mati + $record->afkir;
        $record->hd_percent = ($record->populasi > 0) ? ($record->telur_butir / $record->populasi) * 100 : 0;
        $record->hh_percent = ($record->populasi > 0) ? ($record->telur_butir / $record->populasi) * 100 : 0;
        $record->fcr = ($record->telur_kg > 0) ? $record->pakan_kg / $record->telur_kg : 0;
    }

    /**
     * Handle the DailyProductionRecord "created" event.
     */
    public function created(DailyProductionRecord $dailyProductionRecord): void
    {
        //
    }

    /**
     * Handle the DailyProductionRecord "updated" event.
     */
    public function updated(DailyProductionRecord $dailyProductionRecord): void
    {
        //
    }

    /**
     * Handle the DailyProductionRecord "deleted" event.
     */
    public function deleted(DailyProductionRecord $dailyProductionRecord): void
    {
        //
    }

    /**
     * Handle the DailyProductionRecord "restored" event.
     */
    public function restored(DailyProductionRecord $dailyProductionRecord): void
    {
        //
    }

    /**
     * Handle the DailyProductionRecord "force deleted" event.
     */
    public function forceDeleted(DailyProductionRecord $dailyProductionRecord): void
    {
        //
    }
}
