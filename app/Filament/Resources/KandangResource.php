<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KandangResource\Pages;
use App\Filament\Resources\KandangResource\RelationManagers;
use App\Models\Kandang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;

class KandangResource extends Resource
{
    protected static ?string $model = Kandang::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required()->label('Nama Kandang'),
                TextInput::make('populasi_awal')->required()->numeric()->label('Populasi Awal'),
                DatePicker::make('tanggal_mulai')->label('Tanggal Masuk')->required(),
                TextInput::make('umur_awal')->label('Umur Awal (hari)')->numeric()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('populasi_awal'),
                Tables\Columns\TextColumn::make('tanggal_mulai'),
                Tables\Columns\TextColumn::make('umur_awal'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListKandangs::route('/'),
            'create' => Pages\CreateKandang::route('/create'),
            'edit' => Pages\EditKandang::route('/{record}/edit'),
        ];
    }
}
