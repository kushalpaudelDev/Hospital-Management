<?php

namespace App\Filament\Resources\PharmacyStockResource\Pages;

use App\Filament\Resources\PharmacyStockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPharmacyStocks extends ListRecords
{
    protected static string $resource = PharmacyStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
