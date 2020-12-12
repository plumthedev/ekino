<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GenreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Genre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Action',
                'Comedy',
                'Drama',
                'Fantasy',
                'Horror',
                'Mystery',
                'Romance',
                'Thriller',
            ]),
        ];
    }
}
