<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalRecordResource\Pages;
use App\Models\MedicalRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MedicalRecordResource extends Resource
{
    protected static ?string $model = MedicalRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Medical Records';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Patient Information')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('patient_id')
                            ->relationship('patient', 'first_name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('doctor_id')
                            ->relationship('doctor', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name)
                            ->searchable()
                            ->preload()
                            ->required(),
                    ]),

                Forms\Components\Section::make('Clinical Details')
                    ->schema([
                        Forms\Components\Textarea::make('chief_complaint')
                            ->label('Chief Complaint')
                            ->required()
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('examination_findings')
                            ->label('Examination Findings')
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('diagnosis')
                            ->required()
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('treatment_plan')
                            ->label('Treatment Plan')
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('notes')
                            ->rows(2)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\DatePicker::make('record_date')
                    ->default(now())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('doctor.user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('diagnosis')
                    ->limit(50),
                Tables\Columns\TextColumn::make('record_date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('doctor_id')
                    ->relationship('doctor', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('record_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedicalRecords::route('/'),
            'create' => Pages\CreateMedicalRecord::route('/create'),
            'view' => Pages\ViewMedicalRecord::route('/{record}'),
            'edit' => Pages\EditMedicalRecord::route('/{record}/edit'),
        ];
    }
}
