<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use App\Models\Karyawan;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    private $createKaryawan;
    private $karyawan_id;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['email_verified_at'] = now();
        $this->createKaryawan = $data['create_karyawan'];
        
        return $data;
    }

    protected function afterCreate(): void
    {
        if ($this->createKaryawan) {
            $karyawan = new Karyawan();
            $karyawan->user_id = $this->record->id;
            $karyawan->full_name = $this->record->name;
            $karyawan->address = '-';
            $karyawan->city = '-';
            $karyawan->phone = '088';
            $karyawan->save();

            $this->karyawan_id = $karyawan->id;
        }
    }

    protected function getRedirectUrl(): string
    {
        $back =  $this->previousUrl;
        if($this->createKaryawan)
        {
            return '/dashboard/karyawans/'.$this->karyawan_id.'/edit';
        }else{
            return $back;
        }

    }
}
