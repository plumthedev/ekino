<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->factory()->count(5)->create();
        $this->factory()->nameless()->count(5)->create();
        $this->factory()->notVerified()->count(5)->create();
    }

	/**
	 * Return user factory instance.
	 *
	 * @return \Database\Factories\UserFactory
	 */
	protected function factory(): UserFactory
	{
		return User::factory();
    }
}
