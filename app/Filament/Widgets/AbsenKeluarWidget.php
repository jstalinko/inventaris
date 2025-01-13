<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Absensi;
use App\Models\Karyawan;
use Filament\Widgets\Widget;

class AbsenKeluarWidget extends Widget
{
    protected static string $view = 'filament.widgets.absen-keluar-widget';
    protected array|string|int $columnSpan = 'full';

    protected static ?int $sort = 1;


    public function getViewData(): array
    {

        $datenow = date('d-m-Y');
        $karyawan = Karyawan::where('user_id' , auth()->user()->id)->first();
        $absen = Absensi::where('user_id' , auth()->user()->id)->where('tanggal',$datenow)->where('karyawan_id' , $karyawan->id)->first();

        $setting = json_decode(file_get_contents(storage_path('app/settings.json')) , true);
        $jamOut = $setting['jamkerja']['jam_pulang']; // Misalnya: '17:00:00'

        $jamNow = Carbon::now();
       

        
        $jamPulang = Carbon::createFromFormat('H:i:s', $jamOut);

        
        $diffMinutes = $jamNow->diffInMinutes($jamPulang, false);

        if ($diffMinutes <= 2 ) {
            return [
                'alert' => 'Jam kerja kurang dari 2 menit. Persiapkan untuk absen pulang',
                'button' => true
            ];
        } elseif ($diffMinutes <= 15 ) {
            return [
                'alert' => 'Jam kerja kurang dari 15 menit. Selesaikan pekerjaan yang belum selesai sebelum absen pulang',
                'button' => false
            ];

        } else {
            return [
                'alert' => 'peler',
                'button' => false
            ];
        }
    }
}
