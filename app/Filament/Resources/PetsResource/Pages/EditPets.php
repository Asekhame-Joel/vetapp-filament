<?php

namespace App\Filament\Resources\PetsResource\Pages;

use App\Filament\Resources\PetsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPets extends EditRecord
{
    protected static string $resource = PetsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
