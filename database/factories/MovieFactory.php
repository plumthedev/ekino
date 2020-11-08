<?php

namespace Database\Factories;

class MovieFactory extends CinematographyFactory
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
			'content'     => $this->generateContent(),
			'duration'    => $this->generateDuration(),
			'rating'      => $this->generateRating(),
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
				'rating' => $this->generateRating(4),
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
				'rating' => $this->generateRating(1, 2),
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
}
