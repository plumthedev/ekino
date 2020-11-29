<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionPlanFactory extends Factory
{
	/**
	 * Movie subscription plan name.
	 *
	 * @var string
	 */
	const MOVIE_SUBSCRIPTION_PLAN_NAME = 'movie';

	/**
	 * Series subscription plan name.
	 *
	 * @var string
	 */
	const SERIES_SUBSCRIPTION_PLAN_NAME = 'series';

	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = \App\Models\SubscriptionPlan::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'name'            => $this->faker->word,
			'description'     => $this->faker->realText(),
			'price'           => $this->faker->randomFloat(2, 15, 50),
			'is_featured'     => $this->faker->boolean,
			'access_duration' => $this->faker->randomElement([6, 12, 24, 36, 48, 60, 72]),
		];
	}

	/**
	 * Movie subscription plan state.
	 *
	 * @return \Database\Factories\SubscriptionPlanFactory
	 */
	public function movie(): SubscriptionPlanFactory
	{
		return $this->state(function () {
			return [
				'name'            => self::MOVIE_SUBSCRIPTION_PLAN_NAME,
				'price'           => 30.90,
				'is_featured'     => true,
				'access_duration' => 72,
			];
		});
	}

	/**
	 * Series subscription plan state.
	 *
	 * @return \Database\Factories\SubscriptionPlanFactory
	 */
	public function series(): SubscriptionPlanFactory
	{
		return $this->state(function () {
			return [
				'name'            => self::SERIES_SUBSCRIPTION_PLAN_NAME,
				'price'           => 68.00,
				'is_featured'     => true,
				'access_duration' => 168,
			];
		});
	}
}
