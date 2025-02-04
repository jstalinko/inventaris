<?php

use App\Http\Controllers\JustOrangeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [JustOrangeController::class , 'index']);
Route::get('/absen',[JustOrangeController::class , 'absen'])->name('absen');
Route::get('/absen-keluar', [JustOrangeController::class , 'absenKeluar'])->name('absenKeluar');
Route::get('/data' , function(){
    dd(auth()->user());
});
