<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'pocetna')->name('pocetna');
    Route::get('/proizvodi/{filter?}', 'proizvodi')->name('proizvodi');
    Route::get('/proizvod/{id?}', 'proizvod')->name('proizvod');
    Route::get('/kategorije', 'kategorije')->name('kategorije');
    Route::get('/kontakt', 'kontakt')->name('kontakt');
    Route::get('/prijava', 'prijava')->name('prijava');
    Route::get('/registracija', 'registracija')->name('registracija');
});
