<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // return whatever you want as url

        if(auth()->check() && !auth()->user()->hasRole('super_admin')){
        $url = route('absen');
        }else{
        $url = '/dashboard';
        }

        return redirect()->intended($url);
    }
}
