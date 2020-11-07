<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		$this->createUsers();
		$this->assignRoleToUsers();
	}

	/**
	 * Assign role to users.
	 * Exclude system users.
	 *
	 * @return void
	 */
	protected function assignRoleToUsers(): void
	{
		$systemUsersEmail = array_column(BaseSeeder::SYSTEM_USERS, 'email');
		$users = User::whereNotIn('email', $systemUsersEmail)->get();

		$users->each(function (User $user) {
			$role = Role::where('name', Role::USER)->first();
			$user->assignRole($role);
		});
	}

	/**
	 * Create users.
	 *
	 * @return void
	 */
	protected function createUsers(): void
	{
		$this->userFactory()->count(5)->create();
		$this->userFactory()->nameless()->count(5)->create();
		$this->userFactory()->notVerified()->count(5)->create();
	}

	/**
	 * Return user factory instance.
	 *
	 * @return \Database\Factories\UserFactory
	 */
	protected function userFactory(): UserFactory
	{
		return User::factory();
	}
}
