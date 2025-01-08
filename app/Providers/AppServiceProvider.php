<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function(){
            Filament::registerNavigationGroups([
                'Master Data',
                'Transaksi',
                'User & Roles',
                'Setting'
            ]);
            Filament::registerNavigationItems([
                NavigationItem::make('Buat Transaksi')
                    ->icon('heroicon-o-plus-circle')
                    ->url('/dashboard/history-barangs/create')  // Use url() with the route() helper for internal links
                    ->isActiveWhen(fn () => request()->is('dashboard/history-barangs/create'))
                    ->group('Transaksi'),  // Optional grouping
            ]);
        });
    }
}
