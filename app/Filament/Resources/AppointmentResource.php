<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Maatwebsite\Excel\Excel;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Appointments';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Appointment Details')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('appointment_number')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->prefix('APT-')
                            ->placeholder('2024-001'),
                        Forms\Components\Select::make('patient_id')
                            ->relationship('patient', 'first_name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('doctor_id')
                            ->relationship('doctor', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name)
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\DatePicker::make('appointment_date')
                            ->required()
                            ->minDate(now()),
                        Forms\Components\TimePicker::make('appointment_time')
                            ->required(),
                        Forms\Components\Select::make('type')
                            ->options([
                                'consultation' => 'Consultation',
                                'follow_up' => 'Follow Up',
                                'emergency' => 'Emergency',
                            ])
                            ->default('consultation')
                            ->required(),
                    ]),

                Forms\Components\Section::make('Clinical Information')
                    ->schema([
                        Forms\Components\Textarea::make('symptoms')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('notes')
                            ->rows(2)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Select::make('status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'no_show' => 'No Show',
                    ])
                    ->default('scheduled')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('appointment_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient.full_name')
                    ->searchable(['patients.first_name', 'patients.last_name']),
                Tables\Columns\TextColumn::make('doctor.user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('appointment_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('appointment_time'),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'consultation' => 'info',
                        'follow_up' => 'warning',
                        'emergency' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'scheduled' => 'gray',
                        'confirmed' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        'no_show' => 'warning',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'no_show' => 'No Show',
                    ]),
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'consultation' => 'Consultation',
                        'follow_up' => 'Follow Up',
                        'emergency' => 'Emergency',
                    ]),
                Tables\Filters\Filter::make('appointment_date')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($q) => $q->whereDate('appointment_date', '>=', $data['from']))
                            ->when($data['until'], fn ($q) => $q->whereDate('appointment_date', '<=', $data['until']));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('complete')
                    ->label('Complete')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'confirmed')
                    ->action(function ($record) {
                        $record->update(['status' => 'completed']);
                    }),
                Tables\Actions\Action::make('prescribe')
                    ->label('Prescribe')
                    ->icon('heroicon-o-document-text')
                    ->color('primary')
                    ->visible(fn ($record) => $record->status === 'completed')
                    ->url(fn ($record) => route('filament.admin.resources.medical-records.create', [
                        'appointment_id' => $record->id,
                        'patient_id' => $record->patient_id,
                        'doctor_id' => $record->doctor_id,
                    ])),
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
            ])
            ->defaultSort('appointment_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'view' => Pages\ViewAppointment::route('/{record}'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
