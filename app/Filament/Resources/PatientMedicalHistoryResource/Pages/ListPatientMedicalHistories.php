<?php

namespace App\Filament\Resources\PatientMedicalHistoryResource\Pages;

use App\Filament\Resources\PatientMedicalHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatientMedicalHistories extends ListRecords
{
    protected static string $resource = PatientMedicalHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
