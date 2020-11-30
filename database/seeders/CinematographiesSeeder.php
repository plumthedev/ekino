<?php

namespace Database\Seeders;

use App\Models\Cinematography;
use App\Models\SubscriptionPlan;
use App\Services\ImageGenerator\Contracts\Generator as ImageGenerator;
use Database\Factories\CinematographyFactory;
use Illuminate\Database\Seeder;

class CinematographiesSeeder extends Seeder
{
	/**
	 * Image generator.
	 *
	 * @var \App\Services\ImageGenerator\Contracts\Generator
	 */
	protected $imageGenerator;


	/**
	 * Seeder constructor.
	 *
	 * @param \App\Services\ImageGenerator\Contracts\Generator $imageGenerator
	 */
	public function __construct(ImageGenerator $imageGenerator)
	{
		$this->imageGenerator = $imageGenerator;
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		$this->createMovies();
		$this->createSeries();
	}

	/**
	 * Cinematography factory.
	 *
	 * @return \Database\Factories\CinematographyFactory
	 */
	protected function cinematographyFactory(): CinematographyFactory
	{
		return Cinematography::factory();
	}

	protected function createCinematographiesMedia()
	{
		foreach (Cinematography::all() as $cinematography) {
			$coverUrl = $this->imageGenerator->getUrl();
			$posterUrl = $this->imageGenerator->getUrl(480, 768);
		}
	}

	/**
	 * Create movies.
	 *
	 * @return void
	 */
	protected function createMovies(): void
	{
		$this->movieFactory()->count(2)->premiere()->create();
		$this->movieFactory()->count(2)->recommended()->create();
		$this->movieFactory()->count(2)->recommendedPremiere()->create();
	}

	/**
	 * Create series.
	 *
	 * @return void
	 */
	protected function createSeries(): void
	{
		$this->seriesFactory()->count(2)->premiere()->create();
		$this->seriesFactory()->count(2)->recommended()->create();
		$this->seriesFactory()->count(2)->recommendedPremiere()->create();
	}

	/**
	 * Movie factory.
	 *
	 * @return \Database\Factories\CinematographyFactory
	 */
	protected function movieFactory(): CinematographyFactory
	{
		return $this->cinematographyFactory()->movie();
	}

	/**
	 * Series factory.
	 *
	 * @return \Database\Factories\CinematographyFactory
	 */
	protected function seriesFactory(): CinematographyFactory
	{
		return $this->cinematographyFactory()->series();
	}
}
