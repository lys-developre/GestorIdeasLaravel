<?php

namespace Database\Factories;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IdeaFactory extends Factory
{
    protected $model = Idea::class;

    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(3),
            'user_id' => User::factory(),
            'likes' => $this->faker->numberBetween(0, 20),
        ];
    }
}
