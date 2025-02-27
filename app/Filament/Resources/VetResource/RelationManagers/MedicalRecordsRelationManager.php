<?php

namespace App\Filament\Resources\VetResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicalRecordsRelationManager extends RelationManager
{
    protected static string $relationship = 'medical_records';

//    public static function canCreate(): bool
//     {
//         return auth()->user()->role === 'admin' || auth()->user()->role === 'vet';
//     }

//     public static function canEdit($record): bool
//     {
//         return auth()->user()->role === 'admin' || auth()->user()->role === 'vet';
//     }

//     public static function canDelete($record): bool
//     {
//         return auth()->user()->role === 'admin' || auth()->user()->role === 'vet';
//     }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                forms\Components\Select::make('pet_id')->relationship('pet', 'name'),
                Forms\Components\Textarea::make('condition'),
                Forms\Components\Textarea::make(name: 'treatment'),
                forms\Components\DateTimePicker::make('recorded_at')->required()
                    
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                tables\Columns\TextColumn::make('condition'),
                tables\Columns\TextColumn::make('treatment'),
                tables\Columns\TextColumn::make('pet.name')->label('Pet Name'),
                // tables\Columns\TextColumn::make(name: 'vet.name')   , 
                tables\Columns\TextColumn::make('recorded_at')->label('Recorded At')->date()

                
                ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->hidden(fn() => auth()->user()->role !== 'admin'
                || auth()->user()->role !== 'vet'
            ),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->hidden(fn() => auth()->user()->role !== 'admin'
                || auth()->user()->role !== 'vet'
            ),

                Tables\Actions\DeleteAction::make()->hidden(fn() => auth()->user()->role !== 'admin'
                || auth()->user()->role !== 'vet'
            ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(fn() => auth()->user()->role !== 'admin'
                    || auth()->user()->role !== 'vet'
                ),
                ]),
            ]);
    }
}
