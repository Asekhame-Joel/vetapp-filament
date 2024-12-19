<?php

namespace App\Filament\Resources\OwnersResource\Pages;

use App\Filament\Resources\OwnersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOwners extends EditRecord
{
    protected static string $resource = OwnersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
