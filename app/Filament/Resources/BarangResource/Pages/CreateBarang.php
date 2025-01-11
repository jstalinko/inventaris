<?php

namespace App\Filament\Resources\BarangResource\Pages;

use App\Filament\Resources\BarangResource;
use App\Models\Variant;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBarang extends CreateRecord
{
    protected static string $resource = BarangResource::class;
    public $variants;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->variants = $data['variasi'];

        return $data;
    }

    protected  function afterCreate()
    {
        foreach($this->variants as $var)
        {
            $v = new Variant();
            $v->barang_id = $this->record->id;
            $v->stock = $var['stock'];
            $v->sisa_stock = $var['stock'];
            $v->warna = $var['warna'];
            $v->save();
        }
    }
}
