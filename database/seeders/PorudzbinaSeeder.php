<?php

namespace Database\Seeders;

use App\Models\Porudzbina;
use App\Models\Proizvod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PorudzbinaSeeder extends Seeder
{
    public function run(): void
    {
        $proizvodi = Proizvod::all();

        Korpa:all()->each(function ($korpa) {
            Porudzbina::factory()->create(['korpa_id' => $korpa->id]);
        });
    }
}
