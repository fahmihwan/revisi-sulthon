<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ukuran>
 */
class UkuranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'kategori_id' => $this->faker->randomElement([1, 2])
        ];
    }
}
