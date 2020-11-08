<?php


namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

abstract class CinematographyFactory extends Factory
{
	/**
	 * Generate cinematography content.
	 *
	 * @param int $maxChars
	 *
	 * @return string
	 */
	protected function generateContent(int $maxChars = 1500): string
	{
		return $this->faker->realText($maxChars);
	}

	/**
	 * Generate cinematography duration.
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
	 * Generate cinematography meta.
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
	 * Generate cinematography produced at date.
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
	 * * Generate cinematography rating.
	 *
	 * @param int $min
	 * @param int $max
	 *
	 * @return float
	 */
	protected function generateRating(int $min = 1, int $max = 5): float
	{
		return $this->faker->randomFloat(2, $min, $max);
	}

	/**
	 * Generate cinematography title.
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
