<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientMedicalHistoryResource\Pages;
use App\Models\PatientMedicalHistory;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Maatwebsite\Excel\Excel;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class PatientMedicalHistoryResource extends Resource
{
    protected static ?string $model = PatientMedicalHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make('table')->withWriterType(Excel::XLSX)->label('Export Excel'),
                    ExcelExport::make('table')->withWriterType(Excel::DOMPDF)->label('Export PDF'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exports([
                        ExcelExport::make('table')->withWriterType(Excel::XLSX)->label('Export Excel'),
                        ExcelExport::make('table')->withWriterType(Excel::DOMPDF)->label('Export PDF'),
                    ]),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatientMedicalHistories::route('/'),
            'create' => Pages\CreatePatientMedicalHistory::route('/create'),
            'edit' => Pages\EditPatientMedicalHistory::route('/{record}/edit'),
        ];
    }
}
