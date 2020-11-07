<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MovieFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = \App\Models\Movie::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'title'       => $this->generateTitle(),
			'content'     => $this->faker->realText(1500),
			'duration'    => $this->generateDuration(),
			'rating'      => $this->faker->randomFloat(2, 1, 10),
			'meta'        => $this->generateMeta(),
			'produced_at' => $this->generateProducedAt(),
		];
	}

	/**
	 * High rated movie state.
	 *
	 * @return \Database\Factories\MovieFactory
	 */
	public function highRated(): MovieFactory
	{
		return $this->state(function () {
			return [
				'rating' => $this->faker->randomFloat(2, 8, 10),
			];
		});
	}

	/**
	 * Low rated movie state.
	 *
	 * @return \Database\Factories\MovieFactory
	 */
	public function lowRated(): MovieFactory
	{
		return $this->state(function () {
			return [
				'rating' => $this->faker->randomFloat(2, 1, 3),
			];
		});
	}

	/**
	 * Premiere movie state.
	 *
	 * @return \Database\Factories\MovieFactory
	 */
	public function premiere(): MovieFactory
	{
		return $this->state(function () {
			return [
				'produced_at' => $this->generateProducedAt(now()->subWeek()),
				'meta'        => $this->generateMeta([
					'is_premiere' => true,
				]),
			];
		});
	}

	/**
	 * Recommended movie state.
	 *
	 * @return \Database\Factories\MovieFactory
	 */
	public function recommended(): MovieFactory
	{
		return $this->state(function () {
			return [
				'meta' => $this->generateMeta([
					'is_recommended' => true,
				]),
			];
		});
	}

	/**
	 * Recommended premiere movie state.
	 *
	 * @return \Database\Factories\MovieFactory
	 */
	public function recommendedPremiere(): MovieFactory
	{
		return $this->state(function () {
			return [
				'produced_at' => $this->generateProducedAt(now()->subWeek()),
				'meta'        => $this->generateMeta([
					'is_premiere'    => true,
					'is_recommended' => true,
				]),
			];
		});
	}

	/**
	 * Generate movie duration.
	 *
	 * @return string
	 */
	protected function generateDuration(): string
	{
		$duration = now()->setTime(
			$this->faker->numberBetween(1, 2),
			$this->faker->randomElement([15, 30, 45, 50, 55]),
			0
		);

		return $duration->format('H:i:s');
	}

	/**
	 * Generate movie meta.
	 * Pass additional arguments to overwrite generated.
	 *
	 * @param array $attributes
	 *
	 * @return array
	 */
	protected function generateMeta(array $attributes = []): array
	{
		return array_merge([
			'is_premiere'    => false,
			'is_recommended' => false,
			'trailer_url'    => $this->faker->url,
		], $attributes);
	}

	/**
	 * Generate movie produced at date.
	 * Pass start date to limit date interval in past.
	 *
	 * @param string $startDate
	 *
	 * @return string
	 */
	protected function generateProducedAt(string $startDate = '-30 years'): string
	{
		return $this->faker->dateTimeBetween($startDate)->format('Y-m-d');
	}

	/**
	 * Generate movie title.
	 *
	 * @return string
	 */
	protected function generateTitle(): string
	{
		$title = $this->faker->realText();
		$title = Str::lower($title);
		$title = Str::words($title, $this->faker->numberBetween(1, 4), null);
		$title = Str::ucfirst($title);

		return $title;
	}
}
