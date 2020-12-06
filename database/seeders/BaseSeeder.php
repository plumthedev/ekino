<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Database\Factories\RoleFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
	/**
	 * System users data.
	 *
	 * @var array[]
	 */
	protected $users = [
		[
			'email' => 'developer@strefakursow.pl',
			'role'  => Role::ADMINISTRATOR,
		],
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		$this->createRoles();
		$this->createSystemUsers();
		$this->assignRoleToSystemUsers();
	}

	/**
	 * Assign role to system users.
	 *
	 * @return void
	 */
	protected function assignRoleToSystemUsers(): void
	{
		foreach ($this->users as $user) {
			$systemUser = User::where('email', $user['email'])->firstOrFail();
			$role = Role::firstOrCreate(['name' => $user['role']]);

			$systemUser->assignRole($role);
		}
	}

	/**
	 * Create base system roles.
	 *
	 * @return void
	 */
	protected function createRoles(): void
	{
		$this->roleFactory()->administrator()->create();
		$this->roleFactory()->create();
	}

	/**
	 * Create base system users.
	 *
	 * @return void
	 */
	protected function createSystemUsers(): void
	{
		foreach ($this->users as $user) {

            $this->userFactory()->makeOne([
                'email'    => $user['email'],
                'password' => config('auth.passwords.default.privileged', 'password'),
            ])->saveQuietly(); // save system users without events
        }
	}

	/**
	 * Role factory.
	 *
	 * @return \Database\Factories\RoleFactory
	 */
	protected function roleFactory(): RoleFactory
	{
		return Role::factory();
	}

	/**
	 * User facotry.
	 *
	 * @return \Database\Factories\UserFactory
	 */
	protected function userFactory(): UserFactory
	{
		return User::factory();
	}
}
