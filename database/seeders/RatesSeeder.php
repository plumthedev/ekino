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
		$this->rateFactory()->count(125)->make()
			->each(function (Rate $rate) {
				$cinematography = $this->findRandomCinematography();
				$author = $this->findRandomAuthor();

				$rate->user_id = $author->id;
				$rate->cinematography_id = $cinematography->id;

				$rate->save();
			});
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
	 * Rate factory.
	 *
	 * @return \Database\Factories\RateFactory
	 */
	protected function rateFactory(): RateFactory
	{
		return Rate::factory();
	}
}
