<?php

namespace Database\Seeders;

use App\Models\Kategorija;
use App\Models\Proizvod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProizvodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategorije = Kategorija::all();

        if ($kategorije->isEmpty()) {
            $this->command->warn('Nema dostupnih kategorija. Pokrenite prvo KategorijaSeeder.');
            return;
        }

        foreach ($kategorije as $kategorija) {
            Proizvod::factory()->count(5)->create([
                'kategorija_id' => $kategorija->id,
            ]);
        }
    }
}
