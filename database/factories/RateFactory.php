<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

class RateFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = \App\Models\Rate::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'score'      => $this->faker->randomFloat(2, 1, 5),
			'content'    => $this->faker->realText(500),
			'usefulness' => $this->faker->numberBetween(-25, 25),
		];
	}
}
