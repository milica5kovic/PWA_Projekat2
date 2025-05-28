<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('admin/prijava', [AdminController::class, 'prijava'])->name('prijava');
Route::post('admin/prijava', [AdminController::class, 'auth'])->name('prijavaAkcija');
Route::post('admin/odjava', [AdminController::class, 'odjava'])->name('odjava');


Route::prefix('admin')->middleware("auth")->name('admin.')->controller(AdminController::class)->group(function () {
    Route::get('/', 'pocetna')->name('pocetna');
    Route::get('/proizvodi', 'proizvodi')->name('proizvodi');
    Route::get('/kategorije', 'kategorije')->name('kategorije');
    Route::get('/korisnici', 'korisnici')->name('korisnici');
    Route::get('/porudzbine', 'narudzbe')->name('porudzbine');

    Route::get('/izmeni/{tip}/{id}', 'izmeni')->name('izmeni');
    Route::post('/izmeni/{tip}/{id}', 'izmeniAkcija')->name('izmeniAkcija');

    Route::post('/dodaj/{tip}', 'dodaj')->name('dodaj');
    Route::delete('/brisi/{tip}/{id}', 'obrisi')->name('brisi');
});
