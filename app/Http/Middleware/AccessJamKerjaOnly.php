<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class AccessJamKerjaOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && !auth()->user()->hasRole('super_admin')) {
            // Baca pengaturan dari file settings.json
            $setting = json_decode(file_get_contents(storage_path('app/settings.json')), true);

            // Ambil waktu jam masuk dan jam pulang
            $jamMasuk = $setting['jamkerja']['jam_masuk']; // Format: '08:00:00'
            $jamPulang = $setting['jamkerja']['jam_pulang']; // Format: '17:00:00'

            // Ambil waktu saat ini
            $currentTime = Carbon::now()->format('H:i:s');

            // Periksa apakah waktu saat ini berada di luar jam kerja
            if ($currentTime < $jamMasuk || $currentTime > $jamPulang) {
                // Tampilkan view khusus jika di luar jam kerja
                return response()->view('jamkerja', ['message' => 'Akses hanya diizinkan selama jam kerja.'], 403);
            }
        }

        return $next($request);
    }
}
