<?php

namespace App\Filament\Resources\HistoryBarangResource\Pages;

use Filament\Actions;
use App\Models\Barang;
use App\Models\Variant;
use App\Models\Karyawan;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\HistoryBarangResource;

class CreateHistoryBarang extends CreateRecord
{
    protected  ?string $heading = 'Buat Transaksi Barang';
    protected static string $resource = HistoryBarangResource::class;

    protected  function mutateFormDataBeforeCreate(array $data): array
    {
        $variant = Variant::find($data['variants']);
        if($variant)
        {
            if($data['type']==1){
            $variant->sisa_stock = ($variant->sisa_stock+$data['total']);
            }else{
            $variant->sisa_stock = ($variant->sisa_stock-$data['total']);
            }
            $variant->save();
            $karyawan = Karyawan::where('user_id' , auth()->user()->id)->first();
        $data['user_id'] = auth()->user()->id;
        $data['note'] = $data['note'].' | Transaksi di lakukan oleh : ' . $karyawan->full_name;

        }

        return $data;
    }
    protected function beforeValidate()
    {
        $variant = Variant::find($this->data['variants']);
        if($this->data['total'] > $variant->sisa_stock)
        {
            Notification::make()
                ->title('Stok tidak tersedia')
                ->danger()
                ->body('Permintaan jumlah barang stock tidak mencukupi')
                ->send();
                $this->halt();

        }
    }
}
