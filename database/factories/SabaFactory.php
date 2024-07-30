<?php

namespace Database\Factories;

use App\Models\Saba;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Saba>
 */
class SabaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Saba::class;
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(2, 10001),
            'nis' => $this->faker->unique()->numberBetween(240001, 900001),
            'nik' => fake()->numberBetween(1000000000000000, 9000000000000000),
            'nokk' => fake()->numberBetween(1000000000000000, 9000000000000000),
            'nama_lengkap' => fake()->name(),
            'saudara_kandung' => fake()->boolean ? 'YA' : 'TIDAK',
            'status' => fake()->boolean ? 'Pending' : 'Aktif',

        ];
    }
}
