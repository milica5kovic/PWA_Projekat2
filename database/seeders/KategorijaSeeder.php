<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategorija;

class KategorijaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategorija::factory()->create(
            ['ime' => 'Audio Video']
        );

        Kategorija::factory()->create(
            ['ime' => 'Telefoni']
        );

        Kategorija::factory()->create(
            ['ime' => 'Pametni Sistemi']
        );

        Kategorija::factory()->create(
            ['ime' => 'Mrezna Oprema']
        );

        Kategorija::factory()->create(
            ['ime' => 'Laptopovi']
        );
    }
}
