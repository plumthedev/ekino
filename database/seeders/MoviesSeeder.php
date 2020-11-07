<?php

namespace Database\Seeders;

use App\Models\Movie;
use Database\Factories\MovieFactory;
use Illuminate\Database\Seeder;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createMovies();
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
	 * Movie factory.
	 *
	 * @return \Database\Factories\MovieFactory
	 */
	protected function movieFactory(): MovieFactory
	{
		return Movie::factory();
    }
}
