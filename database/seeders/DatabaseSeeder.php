<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run(): void
	{
		$this->runBaseSeeding();
		$this->runEnvironmentSeeding();
	}

	/**
	 * Run base seeding.
	 * Create system users.
	 *
	 * @return void
	 */
	public function runBaseSeeding(): void
	{
		$this->call(BaseSeeder::class);
	}

	/**
	 * Run seeding method based on current environment.
	 *
	 * @return void
	 */
	public function runEnvironmentSeeding(): void
	{
		$seedingMethodName = $this->composeEnvironmentSeedingMethodName();

		if (!is_string($seedingMethodName) || !method_exists($this, $seedingMethodName)) {
			return;
		}

		$this->$seedingMethodName();
	}

	/**
	 * Run local environment seeding.
	 *
	 * @return void
	 */
	public function runLocalSeeding(): void
	{
        $this->call(UsersSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(GenresSeeder::class);
        $this->call(CinematographiesSeeder::class);
        $this->call(RatesSeeder::class);
        $this->call(ActorsSeeder::class);
        $this->call(SubscriptionPlansSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(AccessesSeeder::class);
    }

	/**
	 * Compose environment seeding method name.
	 *
	 * @return string|null
	 */
	protected function composeEnvironmentSeedingMethodName(): ?string
	{
		$environment = app()->environment();

		if (!is_string($environment)) {
			return null;
		}

		$environment = Str::studly($environment);
		return "run{$environment}Seeding";
	}
}
