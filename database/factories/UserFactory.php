<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
	/**
	 * Default password for the user.
	 *
	 * @var string
	 */
	const DEFAULT_PASSWORD = 'password';

	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = \App\Models\User::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'first_name'        => $this->faker->firstName,
			'last_name'         => $this->faker->lastName,
			'email'             => $this->faker->unique()->safeEmail,
			'password'          => self::DEFAULT_PASSWORD,
			'verified_at' => now(),
		];
	}

	/**
	 * Not verified user state.
	 *
	 * @return \Database\Factories\UserFactory
	 */
	public function notVerified(): UserFactory
	{
		return $this->state(function (){
			return [
				'verified_at' => null,
			];
		});
	}

	/**
	 * Nameless user state.
	 *
	 * @return \Database\Factories\UserFactory
	 */
	public function nameless(): UserFactory
	{
		return $this->state(function (){
			return [
				'first_name' => null,
				'last_name'  => null,
			];
		});
	}
}
