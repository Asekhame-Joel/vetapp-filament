<?php

namespace App\Filament\Widgets;

use App\Models\pets;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Filament\Widgets\Card;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Charts\Charts\LineChart;
use Spatie\Charts\Chart;
use Illuminate\Support\Facades\DB;
use Flowframe\Trend\TrendValue;

class petChart extends ChartWidget
{
    protected static ?string $heading = 'Pets';

    protected function getData(): array
    {
        $data = Trend::model(pets::class)
        ->between(
            start: now()->subYear(),
            end: now(),
        )
        ->perMonth()
        ->count();
 
    return [
        'datasets' => [
            [
                'label' => 'Pets',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
