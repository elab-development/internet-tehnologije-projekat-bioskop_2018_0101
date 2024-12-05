<?php
namespace Database\Factories;

use App\Models\Projekcija;
use App\Models\Film;
use App\Models\Sala;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjekcijaFactory extends Factory
{
    protected $model = Projekcija::class;

    public function definition()
    {
        return [
            'film_id' => Film::factory(),
            'sala_id' => Sala::factory(),
            'datum_vreme' => $this->faker->dateTimeBetween('now', '+1 month'),
            'cena' => $this->faker->randomFloat(2, 300, 1500),
            'broj_slobodnih_mesta' => $this->faker->numberBetween(0, 300),
        ];
    }
}
