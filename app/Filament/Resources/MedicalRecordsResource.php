<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalRecordsResource\Pages;
use App\Filament\Resources\MedicalRecordsResource\RelationManagers;
use App\Models\medical_records;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicalRecordsResource extends Resource
{
    protected static ?string $model = medical_records::class;

    protected static ?string $navigationIcon = 'healthicons-f-health-alt';
    // protected static ?string $navigationTitle= '';
    protected static ?string $navigationLabel = 'Medical Records';
    // protected static ?string $navigationBreadcrumbs = '';

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
        return auth()->user()->role === 'admin' || auth()->user()->role === 'vet';
    }
    public static function canEdit($record): bool
    {
        return auth()->user()->role === 'admin' || auth()->user()->role === 'vet';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    forms\Components\Textarea::make('condition')->required(),
                    forms\Components\Textarea::make('treatment')->required(),
                    forms\Components\DateTimePicker::make('recorded_at')->required(),

                    forms\Components\Select::make('pet_id')->relationship('pet', 'name')
                    ->disabled(fn () => auth()->user()->role !== 'vet' && auth()->user()->role !== 'admin' ),

                    forms\Components\Select::make('vet_id')->relationship('vet', 'name')
                        ->label('Vet Doctor')->hidden(fn() => auth()->user()->role !== 'admin')
                        ->columns(3),
                    // forms\Components\Select::make('vet_id')->relationship('vet', 'name')->label('Vet Doctor')

                ])


                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(components: [
                tables\Columns\TextColumn::make('condition'),
                tables\Columns\TextColumn::make('treatment'),
                tables\Columns\TextColumn::make('pet.name'),
                tables\Columns\TextColumn::make('vet.name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(fn() => auth()->user()->role !== 'admin'
                        && auth()->user()->role !== 'receptionist'),
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
            'index' => Pages\ListMedicalRecords::route('/'),
            'create' => Pages\CreateMedicalRecords::route('/create'),
            'edit' => Pages\EditMedicalRecords::route('/{record}/edit'),
        ];
    }
}
