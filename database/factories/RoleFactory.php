<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = \App\Models\Role::class;

	/**
	 * State for administrator role.
	 *
	 * @return \Database\Factories\RoleFactory
	 */
	public function administrator(): RoleFactory
	{
		return $this->state(function () {
			return [
				'name' => Role::ADMINISTRATOR,
			];
		});
	}

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition(): array
	{
		return [
			'name' => Role::USER,
		];
	}
}
