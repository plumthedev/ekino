<?php

namespace Database\Seeders;

use App\Models\Country;
use Database\Factories\CountryFactory;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCountries();
    }

    /**
     * Create countries by factory.
     *
     * @return void
     */
    protected function createCountries(): void
    {
        $this->countryFactory()->count(5)->create();
    }

    /**
     * Country factory.
     *
     * @return \Database\Factories\CountryFactory
     */
    private function countryFactory(): CountryFactory
    {
        return Country::factory();
    }
}
