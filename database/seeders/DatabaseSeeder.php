<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Game;
use App\Models\UserScore;

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
        // \App\Models\User::factory(10)->create();
        Game::factory(25)->create();
        User::factory(25)->create();
        UserScore::factory(50)->create();

    }
}
