<?php

namespace App\Filament\Widgets;

use App\Models\DailyProductionRecord;
use App\Models\Kandang;
use Filament\Forms;
use Filament\Widgets\Widget;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class ProduksiTelurStat extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.widgets.produksi-telur-stat';

    public $from;
    public $to;
    public $kandang;

    public function mount(): void
    {
        $this->from = now()->subMonth()->toDateString();
        $this->to = now()->toDateString();
        $this->kandang = null;
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\DatePicker::make('from')->label('Dari Tanggal'),
            Forms\Components\DatePicker::make('to')->label('Sampai Tanggal'),
            Forms\Components\Select::make('kandang')
                ->label('Pilih Kandang')
                ->options(Kandang::pluck('nama', 'id'))
                ->searchable()
                ->nullable(),
        ];
    }

    public function getSummary(): array
    {
        $query = DailyProductionRecord::query();

        if ($this->from) {
            $query->whereDate('tanggal', '>=', $this->from);
        }
        if ($this->to) {
            $query->whereDate('tanggal', '<=', $this->to);
        }
        if ($this->kandang) {
            $query->where('kandang_id', $this->kandang);
        }

        return [
            'butir' => $query->sum('telur_butir'),
            'kg' => $query->sum('telur_kg'),
            'retak' => $query->sum('telur_retak'),
            'kotor' => $query->sum('telur_kotor'),
        ];
    }
}
