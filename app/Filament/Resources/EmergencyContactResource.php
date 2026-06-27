<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmergencyContactResource\Pages;
use App\Models\EmergencyContact;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EmergencyContactResource extends Resource
{
    protected static ?string $model = EmergencyContact::class;

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
            'index' => Pages\ListEmergencyContacts::route('/'),
            'create' => Pages\CreateEmergencyContact::route('/create'),
            'edit' => Pages\EditEmergencyContact::route('/{record}/edit'),
        ];
    }
}
