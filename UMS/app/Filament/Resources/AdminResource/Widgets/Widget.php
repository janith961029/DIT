<?php

namespace App\Filament\Resources\AdminResource\Widgets;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\Employee;



class Widget extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getStats(): array
    {
        return [
            Stat::make('', Employee::all()->count())
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7,2,10,3,15,4,17]),
                Stat::make('Unique views', '192.1k')
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7,2,10,3,15,4,17])
                ->color('success'),
            Stat::make('Bounce rate', '21%')
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
