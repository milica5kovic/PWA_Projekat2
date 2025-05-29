<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Korpa extends Model
{
    /** @use HasFactory<\Database\Factories\KorpaFactory> */
    use HasFactory, Notifiable;
    protected $fillable = ["korisnik_id"];

    public function korisnik()
    {
        return $this->belongsTo(User::class);
    }

    public function predmetiKorpe()
    {
        return $this->hasMany(PredmetKorpe::class);
    }
}
