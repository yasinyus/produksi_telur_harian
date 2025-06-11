<?php

namespace App\Filament\Resources\DailyProductionRecordResource\Pages;

use App\Filament\Resources\DailyProductionRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyProductionRecords extends ListRecords
{
    protected static string $resource = DailyProductionRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
