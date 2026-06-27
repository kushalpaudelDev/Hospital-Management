<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrescriptionResource\Pages;
use App\Models\Prescription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PrescriptionResource extends Resource
{
    protected static ?string $model = Prescription::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Medical Records';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Prescription Details')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('medical_record_id')
                            ->relationship('medicalRecord', 'id')
                            ->searchable()
                            ->preload()
                            ->required(),
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

                Forms\Components\Section::make('Medicines')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship('items')
                            ->schema([
                                Forms\Components\Select::make('medicine_id')
                                    ->relationship('medicine', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Forms\Components\TextInput::make('dosage')
                                    ->placeholder('e.g., 1 tablet 3 times daily')
                                    ->required(),
                                Forms\Components\TextInput::make('quantity')
                                    ->numeric()
                                    ->default(1)
                                    ->required(),
                                Forms\Components\Textarea::make('instructions')
                                    ->rows(2),
                            ])
                            ->columns(2)
                            ->addActionLabel('Add Medicine')
                            ->reorderable(),
                    ]),

                Forms\Components\Textarea::make('instructions')
                    ->label('General Instructions')
                    ->rows(3)
                    ->columnSpanFull(),

                Forms\Components\DatePicker::make('prescribed_date')
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
                Tables\Columns\TextColumn::make('prescribed_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('items_count')
                    ->counts('items')
                    ->label('Medicines'),
            ])
            ->filters([
                //
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
            ->defaultSort('prescribed_date', 'desc');
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
            'index' => Pages\ListPrescriptions::route('/'),
            'create' => Pages\CreatePrescription::route('/create'),
            'view' => Pages\ViewPrescription::route('/{record}'),
            'edit' => Pages\EditPrescription::route('/{record}/edit'),
        ];
    }
}
