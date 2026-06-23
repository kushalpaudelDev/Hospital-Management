<?php

namespace App\Filament\Resources\DispensedMedicineResource\Pages;

use App\Filament\Resources\DispensedMedicineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDispensedMedicine extends EditRecord
{
    protected static string $resource = DispensedMedicineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
