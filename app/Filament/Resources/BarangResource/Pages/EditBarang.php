<?php

namespace App\Filament\Resources\BarangResource\Pages;

use Filament\Actions;
use App\Models\Variant;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\BarangResource;

class EditBarang extends EditRecord
{
    protected static string $resource = BarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $variant = Variant::select('stock', 'warna')->where('barang_id', $data['id'])->get();
        $data['variasi'] = collect($variant);


        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        
        Variant::where('barang_id',$this->record->id)->delete();
        
        foreach($data['variasi'] as $var)
        {
            $v = new Variant();
            $v->barang_id = $this->record->id;
            $v->stock = $var['stock'];
            $v->sisa_stock = $var['stock'];
            $v->warna = $var['warna'];
            $v->save();
        }

        return $data;
    }
}
