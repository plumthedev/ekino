<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'      => $this->faker->firstName,
            'last_name'       => $this->faker->lastName,
            'email'           => $this->faker->unique()->safeEmail,
            'country'         => 'pl',
            'phone_number'    => $this->faker->phoneNumber,
            'street_address'  => $this->faker->streetAddress,
            'building_number' => $this->faker->buildingNumber,
            'zip_code'        => $this->faker->postcode,
            'city'            => $this->faker->city,
            'password'        => config('auth.passwords.default.standard', 'password'),
            'verified_at'     => now(),
        ];
    }

    /**
     * Nameless user state.
     *
     * @return \Database\Factories\UserFactory
     */
    public function nameless(): UserFactory
    {
        return $this->state(function () {
            return [
                'first_name' => null,
                'last_name'  => null,
            ];
        });
    }

    /**
     * Not verified user state.
     *
     * @return \Database\Factories\UserFactory
     */
    public function notVerified(): UserFactory
    {
        return $this->state(function () {
            return [
                'verified_at' => null,
            ];
        });
    }
}
