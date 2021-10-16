<?php

namespace Database\Factories;
use App\Models\UserScore;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserScoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserScore::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() : array
    {
        return [
            'score' => $this->faker->numberBetween(1, 1000),
            'user_id_fk' => $this->faker->numberBetween(1, 100),
            'game_id_fk' => $this->faker->numberBetween(1,25)
        ];
    }
}
