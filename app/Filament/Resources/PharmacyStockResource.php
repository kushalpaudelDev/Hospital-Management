<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PharmacyStockResource\Pages;
use App\Models\PharmacyStock;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PharmacyStockResource extends Resource
{
    protected static ?string $model = PharmacyStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListPharmacyStocks::route('/'),
            'create' => Pages\CreatePharmacyStock::route('/create'),
            'edit' => Pages\EditPharmacyStock::route('/{record}/edit'),
        ];
    }
}
