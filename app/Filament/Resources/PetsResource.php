<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetsResource\Pages;
use App\Filament\Resources\PetsResource\RelationManagers;
use App\Models\pets;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PetsResource extends Resource
{
    protected static ?string $model = Pets::class;
  

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                forms\Components\TextInput::make('name')->maxLength(255)->required(),
                forms\Components\Select::make('type')->options([
                    'cat' => 'Cat',
                    'dog' => 'Dog',
                    'rabbit' => 'Rabbit',
                ])->required(),
                forms\Components\TextInput::make('age')->required(),
                forms\Components\Select::make('owner_id')
                ->relationship('owner', 'name')->required()->searchable()->preload(),
                forms\Components\FileUpload::make('photo')->disk('public')->directory('photo')
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            tables\Columns\TextColumn::make('name'),
            tables\Columns\TextColumn::make('type'),
            tables\Columns\TextColumn::make('age'),
            tables\Columns\TextColumn::make('owner.name')->searchable(),
            tables\Columns\ImageColumn::make('photo')->rounded(),
            ])
            ->filters([
                tables\Filters\SelectFilter::make('type')->options([
                    'cat' => 'Cat',
                    'dog' => 'Dog',
                    'rabbit' => 'Rabbit',
                ])
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

    // public static function getWidgets(): array
    // {
    //     return [
    //         PetsResource\Widgets\PetsOverview::class,
    //     ];
    // }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPets::route('/'),
            'create' => Pages\CreatePets::route('/create'),
            'edit' => Pages\EditPets::route('/{record}/edit'),
        ];
    }
}
