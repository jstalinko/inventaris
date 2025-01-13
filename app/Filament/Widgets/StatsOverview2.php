<?php

namespace App\Filament\Widgets;

use App\Models\Barang;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview2 extends BaseWidget
{
    protected function getStats(): array
    {
        $laba = 0;
        $modal =0;
        $omzet =0;
        //$omzet = Barang::getTotalOmzet();
        return [
            // Stat::make('Total Modal' , $modal),
            // Stat::make('Total Omzet',$omzet),
            // Stat::make('Total Laba',$laba),
        ];
    }
}
