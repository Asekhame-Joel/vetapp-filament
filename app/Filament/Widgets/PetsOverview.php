<?php

namespace App\Filament\Widgets;

use App\Models\appointments;
use App\Models\invoices;
use App\Models\medical_records;
use App\Models\owners;
use App\Models\pets;
use App\Models\User;
use App\Models\Vet;
// use Filament\Forms\Components\Card;
use Filament\Widgets\StatsOverviewWidget\Card;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PetsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Owners', owners::query()->count())
            ->description('Total Registered Owners')
            ->descriptionIcon('heroicon-o-users')
            ->color('success'),


        Card::make('Vets', Vet::query()->count())
            ->description('Available Veterinarians')
            ->descriptionIcon('heroicon-o-users')
            ->color('primary'),

        Card::make('Pets', pets::query()->count())
            ->description('Pets Registered')
            ->descriptionIcon('heroicon-o-users')
            ->color('info'),

        Card::make('Appointments', appointments::query()->count())
            ->description('Scheduled Appointments')
            ->descriptionIcon('heroicon-o-calendar')
            ->color('warning'),

        Card::make('Invoices', invoices::query()->count())
            ->description('Generated Invoices')
            ->descriptionIcon('heroicon-o-document-text')
            ->color('secondary'),

        Card::make('Medical Records', medical_records::query()->count())
            ->description('Medical Records Logged')
            ->descriptionIcon('heroicon-o-document-text')
            ->color('danger')
        ];
    }
}
