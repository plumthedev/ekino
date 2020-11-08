<?php

namespace Database\Factories;

use App\Models\Actor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActorFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Actor::class;

	/**
	 * Actor default state.
	 *
	 * @return array
	 */
	public function definition(): array
	{
		return [
			'first_name' => $this->faker->firstName,
			'last_name'  => $this->faker->lastName,
			'biography'  => $this->generateBiography(),
		];
	}

	/**
	 * Actor perform state.
	 *
	 * @return array
	 */
	public function performs(): array
	{
		return [
			'perform_name' => $this->generatePerformName(),
		];
	}

	/**
	 * Generate actor biography.
	 *
	 * @return string|null
	 */
	protected function generateBiography(): ?string
	{
		if (!$this->faker->boolean) {
			return null;
		}

		return $this->faker->realText(
			$this->faker->numberBetween(250, 1500)
		);
	}

	/**
	 * Generate perform name for actor.
	 *
	 * @return string
	 */
	protected function generatePerformName(): string
	{
		$firstName = $this->faker->firstName;

		if ($this->faker->boolean) {
			return $firstName;
		}

		return "{$firstName} {$this->faker->lastName}";
	}
}
