<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proizvod>
 */
class ProizvodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ime' => $this->faker->words(3, true),
            'opis' => $this->faker->paragraph(3),
            'cena' => $this->faker->randomFloat(2, 100, 50000),
            'oznaceno' => random_int(0, 1)
        ];

    }
}
