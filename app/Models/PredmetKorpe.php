<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PredmetKorpe extends Model
{
    protected $fillable = ["korpa_id", "proizvod_id", "kolicina"];
}
