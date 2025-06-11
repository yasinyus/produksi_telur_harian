<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DailyProductionRecord;
use App\Models\Kandang;
use Carbon\Carbon;

class ProduksiTelurChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Produksi Telur Harian per Kandang';

    public function getHeading(): string
    {
        $totalButir = DailyProductionRecord::sum('telur_butir');
        $totalKg = DailyProductionRecord::sum('telur_kg');

        return "Total Produksi: {$totalButir} Butir / " . number_format($totalKg, 2) . " Kg";
    }

    protected function getData(): array
    {
        // Ambil semua tanggal unik produksi
        $tanggalRange = DailyProductionRecord::orderBy('tanggal')
            ->pluck('tanggal')
            ->unique()
            ->sort()
            ->values()
            ->map(fn ($tanggal) => Carbon::parse($tanggal)->format('Y-m-d'));

        if ($tanggalRange->isEmpty()) {
            $tanggalRange = collect([Carbon::now()->format('Y-m-d')]);
        }

        $datasets = [];
        $kandangs = Kandang::all();

        foreach ($kandangs as $kandang) {
            $dataButir = [];
            $dataKg = [];

            foreach ($tanggalRange as $tanggal) {
                $record = DailyProductionRecord::where('kandang_id', $kandang->id)
                    ->whereDate('tanggal', $tanggal)
                    ->first();

                $dataButir[] = $record ? $record->telur_butir : 0;
                $dataKg[] = $record ? $record->telur_kg : 0;
            }

            // Dataset Butir
            $datasets[] = [
                'label' => "{$kandang->nama} (Butir)",
                'data' => $dataButir,
                'fill' => false,
                'tension' => 0.4,
                'borderColor' => $this->randomColor(),
                'backgroundColor' => $this->randomColor(0.2),
                'yAxisID' => 'y',
            ];

            // Dataset Kg
            $datasets[] = [
                'label' => "{$kandang->nama} (Kg)",
                'data' => $dataKg,
                'fill' => false,
                'tension' => 0.4,
                'borderDash' => [5, 5], // beda style untuk kg
                'borderColor' => $this->randomColor(),
                'backgroundColor' => $this->randomColor(0.2),
                'yAxisID' => 'y1',
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $tanggalRange->map(fn ($tgl) => Carbon::parse($tgl)->format('d M')),
            'options' => [
                'scales' => [
                    'y' => [
                        'type' => 'linear',
                        'position' => 'left',
                        'title' => ['display' => true, 'text' => 'Butir']
                    ],
                    'y1' => [
                        'type' => 'linear',
                        'position' => 'right',
                        'title' => ['display' => true, 'text' => 'Kg'],
                        'grid' => ['drawOnChartArea' => false],
                    ]
                ]
            ]
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function randomColor($opacity = 1)
    {
        $r = rand(50, 200);
        $g = rand(50, 200);
        $b = rand(50, 200);
        return "rgba($r, $g, $b, $opacity)";
    }
}
