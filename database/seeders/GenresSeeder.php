<?php

namespace Database\Seeders;

use App\Models\Genre;
use Database\Factories\GenreFactory;
use Illuminate\Database\Seeder;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createGenres();
    }

    /**
     * Create genres.
     *
     * @return void
     */
    protected function createGenres(): void
    {
        $this->genreFactory()->count(
            mt_rand(4, 8)
        )->create();
    }

    /**
     * Genre factory.
     *
     * @return \Database\Factories\GenreFactory
     */
    private function genreFactory(): GenreFactory
    {
        return Genre::factory();
    }
}
