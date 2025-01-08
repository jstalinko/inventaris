<?php

namespace App\Filament\Resources\HistoryBarangResource\Pages;

use App\Filament\Resources\HistoryBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHistoryBarang extends EditRecord
{
    protected static string $resource = HistoryBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
