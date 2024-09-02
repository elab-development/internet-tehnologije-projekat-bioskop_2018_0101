<?php
namespace Database\Factories;

use App\Models\Sala;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalaFactory extends Factory
{
    protected $model = Sala::class;

    public function definition()
    {
        return [
            'naziv' => $this->faker->word,
            'broj_sedista' => $this->faker->numberBetween(50, 300),
            'vrsta_sale' => $this->faker->randomElement(['Regularna', '3D', 'IMAX']),
            'oprema' => $this->faker->sentence,
            'dostupnost' => $this->faker->boolean,
            'napomena' => $this->faker->optional()->sentence,
        ];
    }
}
