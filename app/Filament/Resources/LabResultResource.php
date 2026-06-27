<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LabResultResource\Pages;
use App\Models\LabResult;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LabResultResource extends Resource
{
    protected static ?string $model = LabResult::class;

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
            'index' => Pages\ListLabResults::route('/'),
            'create' => Pages\CreateLabResult::route('/create'),
            'edit' => Pages\EditLabResult::route('/{record}/edit'),
        ];
    }
}
