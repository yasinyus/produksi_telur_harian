<?php

namespace App\Filament\Resources\DailyProductionRecordResource\Pages;

use App\Filament\Resources\DailyProductionRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyProductionRecord extends EditRecord
{
    protected static string $resource = DailyProductionRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
