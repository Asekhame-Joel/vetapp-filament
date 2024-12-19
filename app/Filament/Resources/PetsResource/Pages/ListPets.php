<?php

namespace App\Filament\Resources\PetsResource\Pages;

use App\Filament\Resources\PetsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPets extends ListRecords
{
    protected static string $resource = PetsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-c-plus')->iconPosition('before'),
        ];
    }
}
