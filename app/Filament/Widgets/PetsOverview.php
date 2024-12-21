<?php

namespace App\Filament\Widgets;

use App\Models\appointments;
use App\Models\invoices;
use App\Models\medical_records;
use App\Models\owners;
use App\Models\pets;
use App\Models\User;
use App\Models\Vet;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PetsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Cats', pets::query()->where('type', 'cat')->count()),
            Stat::make('Dogs', pets::query()->where('type', 'dog')->count()),
            Stat::make('Rabbits', pets::query()->where('type', 'rabbit')->count()),
            Stat::make('Owners', value: owners::query()->count()),
            Stat::make('Vets', value: Vet::query()->count()),
            Stat::make('Users', value: User::query()->count()),
            Stat::make('Appointments', value: appointments::query()->count()),
            Stat::make('Invoices', value: invoices::query()->count()),
            Stat::make('Medical Records', value: medical_records::query()->count()),




          
        ];
    }
}
