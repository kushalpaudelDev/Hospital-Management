<?php

namespace App\Filament\Resources\DispensedMedicineResource\Pages;

use App\Filament\Resources\DispensedMedicineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDispensedMedicines extends ListRecords
{
    protected static string $resource = DispensedMedicineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
