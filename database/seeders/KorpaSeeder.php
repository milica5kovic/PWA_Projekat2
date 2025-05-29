<?php

namespace Database\Seeders;

use App\Models\Korpa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KorpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        User::all()->each(function ($user) {
            Korpa::factory()->create(['korisnik_id' => $user->id]);
        });

    }
}
