<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KorisnikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@pwa.rs',
            'password' => bcrypt('password123'),
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Editor User',
            'email' => 'editor@pwa.rs',
            'password' => bcrypt('password123'),
            'role' => 'editor'
        ]);

        User::factory()->create([
            'name' => 'Prvulovic Petar',
            'email' => 'user@pwa.rs',
            'password' => bcrypt('password123'),
            'role' => 'registered'
        ]);
    }
}
