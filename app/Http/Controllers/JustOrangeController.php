<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class JustOrangeController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('justorange-default');
    }

    public function absen()
    {
        $data['user'] = auth()->user();
        $data['signature'] = sha1(date('dmY'));
        $data['karyawan'] = Karyawan::where('user_id' , auth()->user()->id)->first();
        $data['setting'] = json_decode(file_get_contents(storage_path('app/settings.json')) , true);
        return Inertia::render('absen' , $data);
    }

    public function doAbsen(Request $request)
    {
        $datenow = date('d-m-Y');
        $user = User::find($request->user_id);
        if(!$user)
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'User not found'
                ],
                200,
                [],
                JSON_PRETTY_PRINT
                );
        }

        $karyawan = Karyawan::where('user_id' , $user->id)->first();
        if(!$karyawan)
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'User di temukan namun tidak memiliki data karyawan'
                ],
                200,
                [],
                JSON_PRETTY_PRINT
            );
        }


        $absensi = Absensi::where('tanggal' , $datenow)->where('user_id' , $user->id)->where('karyawan_id',$karyawan->id)->first();
        if(!$absensi)
        {
    

            $cutoffTime = '08:00:00';
            $currentTime = date('H:i:s');

            $abs = new Absensi();
            $abs->user_id = $user->id;
            $abs->type = 'masuk';
            $abs->karyawan_id = $karyawan->id;
            $abs->tanggal = $datenow;
            $abs->jam = $currentTime;

            $abs->signature = $request->signature;
            if (strtotime($currentTime) > strtotime($cutoffTime)) {
                $abs->status = 'terlambat';
                $lateMinutes = (strtotime($currentTime) - strtotime($cutoffTime)) / 60;
                $abs->note = 'Absen masuk pada tanggal: ' . $datenow . 
                             ' Jam: ' . $currentTime . ' WIB. ' .
                             'Terlambat ' . round($lateMinutes) . ' menit.';
            } else {
                $abs->status = 'tepat_waktu';
                $abs->note = 'Absen masuk pada tanggal: ' . $datenow . 
                             ' Jam: ' . $currentTime . ' WIB. Tepat waktu.';
            }
            $abs->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Absen masuk berhasil !'
                ],
                200,
                [],
                JSON_PRETTY_PRINT
            );
        }else{

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Anda sudah absen masuk!'
                ],
                200,
                [],
                JSON_PRETTY_PRINT
            );
        }

    }
}
