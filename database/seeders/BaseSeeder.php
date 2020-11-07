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
	const SYSTEM_USERS = [
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
		foreach (self::SYSTEM_USERS as $user) {
			$systemUser = User::where('email', $user['email'])->first();
			$role = Role::where('name', $user['role'])->first();

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
		foreach (self::SYSTEM_USERS as $user) {
			$this->userFactory()->createOne([
				'email'    => $user['email'],
				'password' => env('SYSTEM_USER_PASSWORD', UserFactory::DEFAULT_PASSWORD),
			]);
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
