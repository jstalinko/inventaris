<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AbsenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $datenow = date('d-m-Y');
        
        if(auth()->check() && !auth()->user()->hasRole('super_admin')) // check dulu untuk semua roles.
        {
            $karyawan = Karyawan::where('user_id' , auth()->user()->id)->first();
            if(!$karyawan)
            {
                dd("User anda terdaftar, namun tidak terdaftar dalam staff/karyawan");
            }
            $absen = Absensi::where('user_id' , auth()->user()->id)->where('tanggal',$datenow)->where('karyawan_id' , $karyawan->id)->first();
            if(!$absen)
            {
                return redirect('/absen');
            }
        }
        return $next($request);
    }
}
