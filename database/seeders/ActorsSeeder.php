<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

use App\Models\Actor;
use App\Models\Cinematography;
use App\Services\MediaGenerator\Contracts\Service as MediaGenerator;
use Database\Factories\ActorFactory;


class ActorsSeeder extends Seeder
{
    /**
     * Image generator.
     *
     * @var \App\Services\MediaGenerator\Contracts\Service
     */
    protected $mediaGenerator;

    /**
     * Faker generator.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Seeder constructor.
     *
     * @param \App\Services\MediaGenerator\Contracts\Service $mediaGenerator
     * @param \Faker\Generator                               $faker
     */
    public function __construct(MediaGenerator $mediaGenerator, Faker $faker)
    {
        $this->mediaGenerator = $mediaGenerator;
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createActors();
        $this->assignActorsToCinematographies();
        $this->createActorsMedia();
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
     * Create actor avatars.
     *
     * @param \App\Models\Actor $actor
     *
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    protected function createActorAvatar(Actor $actor): void
    {
        $avatar = $this->mediaGenerator->personImage()->getMedia();

        $actor
            ->addMedia($avatar)
            ->toMediaCollection(Actor::MEDIA_COLLECTION_AVATAR);
    }

    /**
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    protected function createActorsMedia(): void
    {
        foreach (Actor::all() as $actor) {
            if ($this->faker->boolean(75)) {
                $this->createActorAvatar($actor);
            }
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
