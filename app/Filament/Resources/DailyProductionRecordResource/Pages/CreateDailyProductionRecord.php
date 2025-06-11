<?php

namespace App\Filament\Resources\DailyProductionRecordResource\Pages;

use App\Filament\Resources\DailyProductionRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDailyProductionRecord extends CreateRecord
{
    protected static string $resource = DailyProductionRecordResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
