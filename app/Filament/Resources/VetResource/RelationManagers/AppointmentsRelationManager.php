<?php

namespace App\Filament\Resources\VetResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppointmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'appointments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                forms\Components\DateTimePicker::make('appointment_date')->label('Appointment Date'
                )->required(),
                    forms\Components\Textarea::make(name: 'notes')->required(),
                    forms\Components\Select::make('pet_id')->relationship('pet', 'name'),
                    forms\Components\Select::make('vet_id')->relationship('vet', 'name')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('appointment_date')
            ->columns([
                tables\Columns\TextColumn::make('appointment_date')->dateTime(),
                tables\Columns\TextColumn::make('pet.name'),
                tables\Columns\TextColumn::make('vet.name'),  
                          ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
