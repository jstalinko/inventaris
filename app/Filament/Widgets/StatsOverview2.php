<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview2 extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Stat::make('Total Modal' , 0),
            // Stat::make('Total Omzet',0),
            // Stat::make('Laba Bersih',0),
        ];
    }
}
