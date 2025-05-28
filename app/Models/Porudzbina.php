<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Porudzbina extends Model
{
    /** @use HasFactory<\Database\Factories\PorudzbinaFactory> */
    use HasFactory, Notifiable;
}
