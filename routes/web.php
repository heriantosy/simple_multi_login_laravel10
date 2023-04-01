<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Beranda;
use App\Http\Controllers\Kasir;
use App\Http\Middleware\CekUserLogin;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('login', [LoginController::class, 'index'])->name('login');
Route::controller(LoginController::class)->group(function () {
    Route::get('login','index')->name('login');
    Route::post('login/proses','proses');
    Route::get('logout', 'logout');
    // Route::get('logout')->name('logout');
});

Route::group(['middleware' => ['auth']],function() {
    // Route::group(['middleware' => ['cekUserLogin:1,2']],function () {
        Route::group(['middleware' => ['cekUserLogin:1']],function () {
        Route::resource('beranda', Beranda::class);
        //Route::get('/beranda', 'App\Http\Controllers\Beranda@index'); //or using this route
    });

    Route::group(['middleware' => ['cekUserLogin:2']],function () {
        Route::resource('kasir', Kasir::class);
        //Route::get('/kasir', 'App\Http\Controllers\Kasir@index'); //or using this route
    });

});
