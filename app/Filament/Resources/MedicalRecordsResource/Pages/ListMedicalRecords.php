<?php

namespace App\Filament\Resources\MedicalRecordsResource\Pages;

use App\Filament\Resources\MedicalRecordsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicalRecords extends ListRecords
{
    protected static string $resource = MedicalRecordsResource::class;
    protected static ?string $title = 'Medical Records';
    // protected static ?string $navigationTitle = 'Medical Records';

    protected function getHeaderActions(): array
    {
        return [
Actions\CreateAction::make()->label('Medical Records')
->icon('heroicon-c-plus')
->iconPosition('before')
        ];
    }
}
