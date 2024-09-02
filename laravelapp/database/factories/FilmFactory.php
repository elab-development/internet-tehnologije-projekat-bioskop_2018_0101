<?php
namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    protected $model = Film::class;

    public function definition()
    {
        return [
            'naziv' => $this->faker->sentence,
            'zanr' => $this->faker->word,
            'trajanje' => $this->faker->numberBetween(90, 180),
            'opis' => $this->faker->paragraph,
            'reziser' => $this->faker->name,
            'glumci' => $this->faker->words(3, true),
            'godina_izdanja' => $this->faker->year,
            'jezik' => $this->faker->languageCode,
            'ocena' => $this->faker->randomFloat(1, 1, 10),
            'poster_url' => $this->faker->imageUrl,
            'trailer_url' => $this->faker->url,
        ];
    }
}
