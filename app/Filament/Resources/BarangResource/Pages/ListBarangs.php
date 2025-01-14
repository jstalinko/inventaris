<?php

namespace App\Filament\Resources\BarangResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\BarangResource;
use App\Filament\Resources\BarangResource\Widgets\BarangWidgetReport;

class ListBarangs extends ListRecords
{
    protected static string $resource = BarangResource::class;

    protected ?string $heading = 'Daftar Barang';


    protected function getHeaderWidgets(): array
    {
        return [
            BarangWidgetReport::class
        ];
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
