<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'   => $this->faker->realText($maxNbChars = 35),
            'content' => $this->faker->realText($maxNbChars = 280),
            'user_id' => User::role('publisher')->inRandomOrder()->first()
        ];
    }
}
