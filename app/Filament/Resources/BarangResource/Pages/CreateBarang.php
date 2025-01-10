<?php

namespace App\Filament\Resources\BarangResource\Pages;

use App\Filament\Resources\BarangResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBarang extends CreateRecord
{
    protected static string $resource = BarangResource::class;

    protected  function mutateFormDataBeforeCreate(array $data): array
    {
         $data['sisa_stock'] = $data['stock'];
        return $data;
    }
}
