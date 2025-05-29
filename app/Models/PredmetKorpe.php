<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Korpa;
use Illuminate\Notifications\Notifiable;

class PredmetKorpe extends Model
{
    /** @use HasFactory<\Database\Factories\PredmetKorpeFactory> */
    use HasFactory, Notifiable;
    protected $fillable = ["korpa_id", "proizvod_id", "kolicina"];

    public function korpa() {
        return $this->belongsTo(Korpa::class);
    }

    public function proizvod() {
        return $this->belongsTo(Proizvod::class);
    }
}
