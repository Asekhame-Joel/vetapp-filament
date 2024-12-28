<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OwnersResource\Pages;
use App\Filament\Resources\OwnersResource\RelationManagers;
use App\Models\owners;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\SoftDeletingScope;

class OwnersResource extends Resource
{
    protected static ?string $model = Owners::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function canViewAny(): bool
{
    return auth()->user()->role === 'admin' || auth()->user()->role === 'receptionist' ; // Only admins can view the resource
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    forms\Components\TextInput::make('name'),
                    forms\Components\TextInput::make('phone'),
                    forms\Components\TextInput::make('email')->unique(),
                    forms\Components\Textarea::make('address'),  
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                tables\Columns\TextColumn::make(name: 'name'),
                tables\Columns\TextColumn::make(name: 'phone'),
                tables\Columns\TextColumn::make(name: 'email'),
                tables\Columns\TextColumn::make(name: 'address'),
                // tables\Columns\TextColumn::make(name: 'created_at'),
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
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PetsRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOwners::route('/'),
            'create' => Pages\CreateOwners::route('/create'),
            'edit' => Pages\EditOwners::route('/{record}/edit'),
        ];
    }
}
