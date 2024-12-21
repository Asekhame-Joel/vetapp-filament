<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentsResource\Pages;
use App\Filament\Resources\AppointmentsResource\RelationManagers;
use App\Models\appointments;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppointmentsResource extends Resource
{
    protected static ?string $model = Appointments::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-date-range';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([

                    forms\Components\DateTimePicker::make('appointment_date')->label('Appointment Date'
                )->required(),
                    forms\Components\Textarea::make(name: 'notes')->required(),
                    forms\Components\Select::make('pet_id')->relationship('pet', 'name'),
                    forms\Components\Select::make('vet_id')->relationship('vet', 'name')
                ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                tables\Columns\TextColumn::make('appointment_date')->dateTime(),
                tables\Columns\TextColumn::make('pet.name'),
                tables\Columns\TextColumn::make('vet.name'),

                tables\Columns\TextColumn::make('notes')  
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointments::route('/create'),
            'edit' => Pages\EditAppointments::route('/{record}/edit'),
        ];
    }
}
