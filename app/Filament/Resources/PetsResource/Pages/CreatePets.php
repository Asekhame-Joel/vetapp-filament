<?php

namespace App\Filament\Resources\PetsResource\Pages;

use App\Filament\Resources\PetsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePets extends CreateRecord
{
    protected static string $resource = PetsResource::class;
}
