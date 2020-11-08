<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Cinematography;
use Database\Factories\ActorFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class ActorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->createActors();
    	$this->assignActorsToCinematographies();
    }

	/**
	 * For all actors in database
	 * assign some cinematographic performs.
	 *
	 * @return void
	 */
	protected function assignActorsToCinematographies(): void
	{
		foreach (Actor::all() as $actor) {
			foreach ($this->findSomeCinematographies() as $cinematography) {
				$actor->cinematographies()->attach(
					$cinematography->id,
					$this->actorFactory()->performs()
				);
			}
		}
    }

	/**
	 * Create actors.
	 *
	 * @return void
	 */
	protected function createActors(): void
	{
		$this->actorFactory()->count(25)->create();
    }

	/**
	 * Find some random cinematographies.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	protected function findSomeCinematographies(): Collection
	{
		return Cinematography::inRandomOrder()->take(
			mt_rand(2,8)
		)->get();
    }

	/**
	 * Actor factory.
	 *
	 * @return \Database\Factories\ActorFactory
	 */
	protected function actorFactory(): ActorFactory
	{
		return Actor::factory();
    }
}
