<?php

use App\Http\Controllers\KorisnikController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('korisnik.profil');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/korpa', [KorisnikController::class, 'korpa'])->name('korpa');
});

Route::get('/storage/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $mimeType = File::mimeType($path);
    return response()->file($path, ['Content-Type' => $mimeType]);
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/public.php';
require __DIR__.'/korisnik.php';
