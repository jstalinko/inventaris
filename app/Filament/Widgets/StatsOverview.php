<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Barang;
use App\Models\Karyawan;
use App\Models\Supplier;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;


class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('User',User::count()),
            Stat::make('Karyawan', Karyawan::count()),
            Stat::make('Barang' , Barang::count()),
            Stat::make('Supplier' , Supplier::count())
        ];
    }
}
