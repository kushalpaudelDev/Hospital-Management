<?php

namespace App\Filament\Resources\PharmacyStockResource\Pages;

use App\Filament\Resources\PharmacyStockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPharmacyStock extends EditRecord
{
    protected static string $resource = PharmacyStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
