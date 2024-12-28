<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoicesResource\Pages;
use App\Filament\Resources\InvoicesResource\RelationManagers;
use App\Models\invoices;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoicesResource extends Resource
{
    protected static ?string $model = Invoices::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function canCreate(): bool {
        return auth()->user()->role === 'receptionist' && auth()->user()->role === 'admin';

    }
 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([

                    forms\Components\Select::make('owner_id')->relationship( 'owner',  'name'),
                    forms\Components\Select::make('appointment_id')->relationship('appointments',  'appointment_date'),
                    Forms\Components\TextInput::make('amount')->numeric()->prefix(label: '$')->maxValue(42949672.95),
                    forms\Components\ToggleButtons::make('status')->label('Payment Status')
                    ->options([
                        'paid' => 'Paid',
                        'unpaid' => 'Unpaid',
                    ])
                    ->default('unpaid') // Set the default value
                    ->required()->inline()

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                tables\Columns\TextColumn::make(name: 'owner.name'),
                tables\Columns\TextColumn::make(name: 'appointments.appointment_date')->dateTime(),
                tables\Columns\TextColumn::make(name: 'amount')->money('USD'),
                tables\Columns\TextColumn::make(name: 'status'),
                tables\Columns\TextColumn::make(name: 'created_at')->dateTime()->label('Date')


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->hidden(condition: fn () => auth()->user()->role !== 'receptionist' && auth()->user()->role !== 'admin' ),
                Tables\Actions\DeleteAction::make()
                ->hidden(condition: fn () => auth()->user()->role !== 'receptionist' && auth()->user()->role !== 'admin' ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                    ->hidden(condition: fn () => auth()->user()->role !== 'receptionist' && auth()->user()->role !== 'admin' ),

                ]),
            ]);
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoices::route('/create'),
            'edit' => Pages\EditInvoices::route('/{record}/edit'),
        ];
    }
}
