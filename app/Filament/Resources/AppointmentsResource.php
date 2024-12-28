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
    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();
    
        if ($user->role === 'vet') {
            // Filter pets assigned to the logged-in vet
            return parent::getEloquentQuery()->where('vet_id', $user->id);
        }
        
        // Admins or other roles see all pets
        return parent::getEloquentQuery();
    }
    
    public static function canCreate(): bool
    {
        return auth()->user()->role === 'admin' || auth()->user()->role == 'receptionist';  // Only admin can create
    }


    public static function  canDelete($record): bool
    {
        return auth()->user()->role === 'admin' || auth()->user()->role === 'receptionist';  // Only admin can create
    }
    


    protected static ?string $navigationIcon = 'heroicon-o-calendar-date-range';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([

                    forms\Components\DateTimePicker::make('appointment_date')->label('Appointment Date'
                )->required()->disabled(fn () => auth()->user()->role !== 'admin'
                && auth()->user()->role !== 'receptionist'),
                    forms\Components\Textarea::make(name: 'notes')->required(),

                    forms\Components\Select::make('pet_id')->relationship('pet', 'name')->disabled(fn () => auth()->user()->role !== 'admin'
                    && auth()->user()->role !== 'receptionist')
                    ,
                    forms\Components\Select::make('vet_id')->relationship('vet', 'name')->disabled(fn () => auth()->user()->role !== 'admin'
                    && auth()->user()->role !== 'receptionist')->label('Vet Doctor'),

                    forms\Components\Select::make('owner_id')->relationship('owner', 'name')->disabled(fn () => auth()->user()->role !== 'admin'
                    && auth()->user()->role !== 'receptionist')
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
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(fn () => auth()->user()->role !== 'admin'
                     && auth()->user()->role !== 'receptionist')
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
