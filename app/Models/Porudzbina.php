<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Korpa;
use App\Models\User;

class Porudzbina extends Model
{
    /** @use HasFactory<\Database\Factories\PorudzbinaFactory> */
    use HasFactory, Notifiable;

    public function korpa()
    {
        return $this->belongsTo(Korpa::class);
    }
}
