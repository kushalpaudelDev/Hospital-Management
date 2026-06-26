<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BillResource\Pages;
use App\Models\Bill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BillResource extends Resource
{
    protected static ?string $model = Bill::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Billing';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('bill_number')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\Select::make('patient_id')
                    ->relationship('patient', 'first_name')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('subtotal')
                    ->numeric()
                    ->prefix('Rs.')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('tax_amount')
                    ->numeric()
                    ->prefix('Rs.')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('total_amount')
                    ->numeric()
                    ->prefix('Rs.')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('paid_amount')
                    ->numeric()
                    ->prefix('Rs.')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('balance')
                    ->numeric()
                    ->prefix('Rs.')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'partial' => 'Partial',
                        'paid' => 'Paid',
                        'cancelled' => 'Cancelled',
                    ])
                    ->disabled()
                    ->dehydrated(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bill_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient.full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtotal')
                    ->money('NPR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tax_amount')
                    ->money('NPR'),
                Tables\Columns\TextColumn::make('total_amount')
                    ->money('NPR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('paid_amount')
                    ->money('NPR'),
                Tables\Columns\TextColumn::make('balance')
                    ->money('NPR')
                    ->color(fn ($record) => $record->balance > 0 ? 'danger' : 'success'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'partial' => 'info',
                        'paid' => 'success',
                        'cancelled' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('bill_date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'partial' => 'Partial',
                        'paid' => 'Paid',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('pay')
                    ->label('Record Payment')
                    ->icon('heroicon-o-credit-card')
                    ->color('success')
                    ->visible(fn ($record) => $record->status !== 'paid')
                    ->url(fn ($record) => route('filament.admin.resources.payments.create', [
                        'bill_id' => $record->id,
                    ])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('bill_date', 'desc');
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
            'index' => Pages\ListBills::route('/'),
            'create' => Pages\CreateBill::route('/create'),
            'view' => Pages\ViewBill::route('/{record}'),
            'edit' => Pages\EditBill::route('/{record}/edit'),
        ];
    }
}
