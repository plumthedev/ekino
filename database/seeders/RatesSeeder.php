<?php

namespace Database\Seeders;

use App\Models\Cinematography;
use App\Models\Rate;
use App\Models\User;
use Database\Factories\RateFactory;
use Illuminate\Database\Seeder;

class RatesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		$this->createRates();
	}

	/**
	 * Create rates.
	 *
	 * @return void
	 */
	protected function createRates(): void
	{
		$ratesCount = 0;

		while ($ratesCount < 125) {
			$rate = $this->makeRate();
			$rate->cinematography()->associate(
				$this->findRandomCinematography()
			);

			$rate->save();
			$ratesCount++;
		}
	}

	/**
	 * Find random author from database.
	 *
	 * @return \App\Models\User
	 */
	protected function findRandomAuthor(): User
	{
		return User::inRandomOrder()->first();
	}

	/**
	 * Find random cinematography from database.
	 *
	 * @return \App\Models\Cinematography
	 */
	protected function findRandomCinematography(): Cinematography
	{
		return Cinematography::inRandomOrder()->first();
	}

	/**
	 * Make rate by random author.
	 *
	 * @return \App\Models\Rate
	 */
	protected function makeRate(): Rate
	{
		return $this->findRandomAuthor()->rates()->make(
			$this->rateFactory()->makeOne()->toArray()
		);
	}

	/**
	 * Rate factory.
	 *
	 * @return \Database\Factories\RateFactory
	 */
	protected function rateFactory(): RateFactory
	{
		return Rate::factory();
	}
}
