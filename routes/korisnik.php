<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KorpaController;

Route::prefix('korisnik')->middleware("auth")->name('korpa.')->controller(KorpaController::class)->group(function () {
    Route::POST('/korpa/dodaj/{productId}', 'dodaj_u_korpu')->name('dodaj');
    Route::DELETE('/korpa/brisi/{id}', 'brisi_iz_korpe')->name('brisi');
    Route::post('/korpa/poruci', 'porudzbina')->name('poruci');
    Route::get('/korpa/forma-za-porudzbinu', 'prikaziFormuZaPorudzbinu')->name('forma_za_porudzbinu');
});
