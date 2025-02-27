<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VetResource\Pages;
use App\Filament\Resources\VetResource\RelationManagers;
use App\Filament\Resources\VetResource\RelationManagers\AppointmentsRelationManager;
use App\Filament\Resources\VetResource\RelationManagers\MedicalRecordsRelationManager;
use App\Models\Vet;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VetResource extends Resource
{
    protected static ?string $model = Vet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canViewAny() :bool{
        return auth()->user()->role === 'admin';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    forms\Components\TextInput::make('name'),
                    forms\Components\TextInput::make('specialization'),
                    forms\Components\TextInput::make('email')->email()
                    ])->columns(1)
                ]
                );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            tables\Columns\TextColumn::make('name')->searchable(),
            tables\Columns\TextColumn::make('specialization'),
            tables\Columns\TextColumn::make('email')
            ])

            ->filters([

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
            MedicalRecordsRelationManager::class,
            AppointmentsRelationManager::class,


        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVets::route('/'),
            'create' => Pages\CreateVet::route('/create'),
            'edit' => Pages\EditVet::route('/{record}/edit'),
        ];
    }
}
