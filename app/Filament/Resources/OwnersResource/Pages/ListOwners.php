<?php

namespace App\Filament\Resources\OwnersResource\Pages;

use App\Filament\Resources\OwnersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOwners extends ListRecords
{
    protected static string $resource = OwnersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-c-plus')->iconPosition('before'),
        ];
    }
}
