<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Film;
use App\Models\Projekcija;
use App\Models\Sala;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Sala::factory()->count(10)->create();
       Projekcija::factory()->count(20)->create();
        Film::factory()->count(5)->create();
        User::factory()->count(5)->create();
    }
}
