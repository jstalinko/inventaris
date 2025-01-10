<?php

namespace App\Filament\Resources\HistoryBarangResource\Pages;

use Filament\Actions;
use App\Models\Barang;
use App\Models\Karyawan;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\HistoryBarangResource;

class CreateHistoryBarang extends CreateRecord
{
    protected  ?string $heading = 'Buat Transaksi Barang';
    protected static string $resource = HistoryBarangResource::class;

    protected  function mutateFormDataBeforeCreate(array $data): array
    {
        $karyawan = Karyawan::where('user_id' , auth()->user()->id)->first();
        $data['user_id'] = auth()->user()->id;
        $data['note'] = $data['note'].' | Transaksi di lakukan oleh : ' . $karyawan->full_name;

        $barang = Barang::find($data['barang_id']);

        if($data['type'] == 1){
        $barang->sisa_stock = ($barang->sisa_stock+$data['total']);
        }elseif($data['type'] == 0){
        $barang->sisa_stock = ($barang->sisa_stock-$data['total']);
        }
        $barang->save();

        return $data;
    }
}
