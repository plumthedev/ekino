<?php

namespace Database\Seeders;

use App\Models\Cinematography;
use Database\Factories\CinematographyFactory;
use Illuminate\Database\Seeder;

class CinematographiesSeeder extends Seeder
{
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

	/**
	 * Create movies.
	 *
	 * @return void
	 */
	protected function createMovies(): void
	{
		$this->movieFactory()->count(2)->highRated()->create();
		$this->movieFactory()->count(2)->lowRated()->create();
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
		$this->seriesFactory()->count(2)->highRated()->create();
		$this->seriesFactory()->count(2)->lowRated()->create();
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
