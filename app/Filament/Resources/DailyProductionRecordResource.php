<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyProductionRecordResource\Pages;
use App\Filament\Resources\DailyProductionRecordResource\RelationManagers;
use App\Models\DailyProductionRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DailyProductionExport;

class DailyProductionRecordResource extends Resource
{
    protected static ?string $model = DailyProductionRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kandang_id')
                ->label('Kandang')
                ->relationship('kandang', 'nama')
                ->required(),
                DatePicker::make('tanggal')->required(),
                // TextInput::make('umur_ayam')->required()->numeric()->label('Umur Ayam (hari)'),
                // TextInput::make('populasi')->disabled()->label('Populasi (otomatis)'),
                TextInput::make('mati')->required()->numeric(),
                TextInput::make('afkir')->required()->numeric(),
                TextInput::make('pakan_kg')->required()->numeric()->label('Pakan (kg)'),
                TextInput::make('telur_butir')->required()->numeric(),
                TextInput::make('telur_kg')->required()->numeric(),
                TextInput::make('telur_retak')->required()->numeric(),
                TextInput::make('telur_kotor')->required()->numeric(),
                Textarea::make('keterangan')->rows(2),
            ])
            ->columns(2);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kandang.nama')->label('Kandang'),
                Tables\Columns\TextColumn::make('tanggal')->date(),
                Tables\Columns\TextColumn::make('umur_ayam')->label('Umur'),
                Tables\Columns\TextColumn::make('populasi'),
                Tables\Columns\TextColumn::make('mati'),
                Tables\Columns\TextColumn::make('afkir'),
                Tables\Columns\TextColumn::make('total_mati_afkir')->label('Total M+A'),
                Tables\Columns\TextColumn::make('pakan_kg')->label('Pakan (kg)'),
                Tables\Columns\TextColumn::make('telur_butir'),
                Tables\Columns\TextColumn::make('telur_kg'),
                Tables\Columns\TextColumn::make('hd_percent')->label('% HD')->formatStateUsing(fn($state) => number_format($state, 2)),
                Tables\Columns\TextColumn::make('hh_percent')->label('% HH')->formatStateUsing(fn($state) => number_format($state, 2)),
                Tables\Columns\TextColumn::make('fcr')->label('FCR')->formatStateUsing(fn($state) => number_format($state, 2)),
            ])
            ->filters([
                Filter::make('Bulan')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('Dari'),
                        Forms\Components\DatePicker::make('to')->label('Sampai'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($q) => $q->whereDate('tanggal', '>=', $data['from']))
                            ->when($data['to'], fn($q) => $q->whereDate('tanggal', '<=', $data['to']));
                    }),
                    Tables\Filters\SelectFilter::make('kandang_id')
                    ->label('Filter Kandang')
                    ->options(
                        \App\Models\Kandang::pluck('nama', 'id')->toArray()
                    )
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // ExportAction::make()->label('Export Excel'),
            ])
                ->headerActions([
                Action::make('Export to Excel')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function () {
                        return Excel::download(new DailyProductionExport, 'produksi_telur.xlsx');
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDailyProductionRecords::route('/'),
            'create' => Pages\CreateDailyProductionRecord::route('/create'),
            'edit' => Pages\EditDailyProductionRecord::route('/{record}/edit'),
        ];
    }
}
