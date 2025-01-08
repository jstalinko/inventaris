<?php

namespace App\Filament\Resources\HistoryBarangResource\Pages;

use Filament\Actions;
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
        return $data;
    }
}
