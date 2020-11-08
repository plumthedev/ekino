<?php

namespace Database\Factories;

use App\Models\Cinematography;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CinematographyFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = \App\Models\Cinematography::class;

	/**
	 * Cinematography default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'type'        => $this->generateType(),
			'title'       => $this->generateTitle(),
			'content'     => $this->generateContent(),
			'duration'    => $this->generateDuration(),
			'rating'      => $this->generateRating(),
			'meta'        => $this->generateMeta(),
			'produced_at' => $this->generateProducedAt(),
		];
	}

	/**
	 * High rated cinematography state.
	 *
	 * @return \Database\Factories\CinematographyFactory
	 */
	public function highRated(): CinematographyFactory
	{
		return $this->state(function () {
			return [
				'rating' => $this->generateRating(4, 5),
			];
		});
	}

	/**
	 * Low rated cinematography state.
	 *
	 * @return \Database\Factories\CinematographyFactory
	 */
	public function lowRated(): CinematographyFactory
	{
		return $this->state(function () {
			return [
				'rating' => $this->generateRating(1, 2),
			];
		});
	}

	/**
	 * Movie type cinematography state.
	 *
	 * @return \Database\Factories\CinematographyFactory
	 */
	public function movie(): CinematographyFactory
	{
		return $this->state(function () {
			return [
				'type' => Cinematography::TYPE_MOVIE,
			];
		});
	}

	/**
	 * Premiere cinematography state.
	 *
	 * @return \Database\Factories\CinematographyFactory
	 */
	public function premiere(): CinematographyFactory
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
	 * Recommended cinematography state.
	 *
	 * @return \Database\Factories\CinematographyFactory
	 */
	public function recommended(): CinematographyFactory
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
	 * Recommended premiere cinematography state.
	 *
	 * @return \Database\Factories\CinematographyFactory
	 */
	public function recommendedPremiere(): CinematographyFactory
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
	 * Series type cinematography state.
	 *
	 * @return \Database\Factories\CinematographyFactory
	 */
	public function series(): CinematographyFactory
	{
		return $this->state(function () {
			return [
				'type'     => Cinematography::TYPE_SERIES,
				'duration' => null
			];
		});
	}

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

	/**
	 * Generate cinematography type.
	 *
	 * @return string
	 */
	protected function generateType(): string
	{
		return $this->faker->randomElement([
			Cinematography::TYPE_MOVIE,
			Cinematography::TYPE_SERIES,
		]);
	}
}
