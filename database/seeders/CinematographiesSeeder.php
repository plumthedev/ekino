<?php

namespace Database\Seeders;

use App\Models\Cinematography;
use App\Services\ImageGenerator\Contracts\Service as ImageGenerator;
use Database\Factories\CinematographyFactory;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class CinematographiesSeeder extends Seeder
{
    /**
     * Image generator.
     *
     * @var \App\Services\ImageGenerator\Contracts\Service
     */
    protected $imageGenerator;

    /**
     * Faker generator.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Seeder constructor.
     *
     * @param \App\Services\ImageGenerator\Contracts\Service $imageGenerator
     * @param \Faker\Generator                               $faker
     */
    public function __construct(ImageGenerator $imageGenerator, Faker $faker)
    {
        $this->imageGenerator = $imageGenerator;
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createCinematographies();
        $this->createCinematographiesMedia();
    }

    /**
     * Add cinematography cover.
     *
     * @param \App\Models\Cinematography $cinematography
     *
     * @return void
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    protected function addCinematographyCover(Cinematography $cinematography): void
    {
        $cover = $this->imageGenerator->picsum()->getImage();

        $cinematography
            ->addMedia($cover)
            ->toMediaCollection(Cinematography::MEDIA_COLLECTION_COVER);
    }

    /**
     * Add cinematography gallery.
     *
     * @param \App\Models\Cinematography $cinematography
     *
     * @return void
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     */
    protected function addCinematographyGallery(Cinematography $cinematography): void
    {
        $gallerySizes = [
            ['width' => 1920, 'height' => 1080],
            ['width' => 640, 'height' => 426],
            ['width' => 840, 'height' => 600],
            ['width' => 1280, 'height' => 1024],
            ['width' => 900, 'height' => 720],
            ['width' => 630, 'height' => 450],
        ];

        for ($i = 0; $i < $this->faker->numberBetween(3, 9); $i++) {
            $size = $this->faker->randomElement($gallerySizes);
            $image = $this->imageGenerator->picsum()->getImage($size['width'], $size['height']);

            $cinematography
                ->addMedia($image)
                ->toMediaCollection(Cinematography::MEDIA_COLLECTION_GALLERY);
        }

    }

    /**
     * Add cinematography poster.
     *
     * @param \App\Models\Cinematography $cinematography
     *
     * @return void
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     */
    protected function addCinematographyPoster(Cinematography $cinematography): void
    {
        $cover = $this->imageGenerator->picsum()->getImage(1008, 792);

        $cinematography
            ->addMedia($cover)
            ->toMediaCollection(Cinematography::MEDIA_COLLECTION_POSTER);
    }

    /**
     * Create cinematography.
     * Movies and series.
     *
     * @return void
     */
    protected function createCinematographies(): void
    {
        $this->createMovies();
        $this->createSeries();
    }

    /**
     * Create cinematography media.
     *
     * @return void
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    protected function createCinematographiesMedia(): void
    {
        foreach (Cinematography::all() as $cinematography) {
            if ($this->faker->boolean(75)) {
                $this->addCinematographyCover($cinematography);
            }

            if ($this->faker->boolean(85)) {
                $this->addCinematographyPoster($cinematography);
            }

            if ($this->faker->boolean) {
                $this->addCinematographyGallery($cinematography);
            }
        }
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
