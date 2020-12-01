<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Cinematography;
use App\Services\ImageGenerator\Contracts\Service as ImageGenerator;
use Database\Factories\ActorFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class ActorsSeeder extends Seeder
{
	/**
	 * Image generator.
	 *
	 * @var \App\Services\ImageGenerator\Contracts\Service
	 */
	protected $imageGenerator;

	/**
	 * Seeder constructor.
	 *
	 * @param \App\Services\ImageGenerator\Contracts\Service $imageGenerator
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
	public function run()
	{
		$this->createActors();
		$this->createActorsAvatar();
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
		$this->actorFactory()->count(10)->create();
	}

	/**
	 * Create actors avatars.
	 *
	 * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded
	 * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
	 * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
	 * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
	 */
	protected function createActorsAvatar(): void
	{
		foreach (Actor::all() as $actor) {
			$avatar = $this->imageGenerator->person()->getImage();

			$actor
				->addMedia($avatar)
				->toMediaCollection(Actor::MEDIA_COLLECTION_AVATAR);
		}
	}

	/**
	 * Find some random cinematographies.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	protected function findSomeCinematographies(): Collection
	{
		return Cinematography::inRandomOrder()->take(
			mt_rand(2, 4)
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
