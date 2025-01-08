<?php

namespace App\Filament\Resources\HistoryBarangResource\Pages;

use App\Filament\Resources\HistoryBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHistoryBarang extends ViewRecord
{
    protected static string $resource = HistoryBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
