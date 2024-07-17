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
            'nama_lengkap' => 'Jangan Dibuka. Data Palsu Broo...',
        ];
    }
}
