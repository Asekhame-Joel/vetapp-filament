<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsersResource\Pages;
use App\Filament\Resources\UsersResource\RelationManagers;
use App\Models\users;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;


class UsersResource extends Resource
{
    protected static ?string $model = Users::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    public static function canViewAny(): bool
{
    return auth()->user()->role === 'admin';
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([

                    forms\Components\TextInput::make('name')->required(),
                    forms\Components\TextInput::make(name: 'email')->required(),
                    forms\Components\Select::make('role')->options([
                        'admin' => 'Admin',
                        'vet' => 'Vet',
                        'receptionist' => 'Receptionist'
                    ])->required(),
                    forms\Components\TextInput::make(name: 'password')->password()->required()
                    ->dehydrateStateUsing(fn (string $state): string => hash::make($state))
        
                ])


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email'),
                // Tables\Columns\TextColumn::make('role')
            ])
            ->filters([
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUsers::route('/create'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    }
}
