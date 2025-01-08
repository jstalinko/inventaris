<?php

namespace App\Filament\Resources\HistoryBarangResource\Pages;

use App\Filament\Resources\HistoryBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHistoryBarangs extends ListRecords
{
    protected static string $resource = HistoryBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
