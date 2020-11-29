<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = \App\Models\Order::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition(): array
	{
		return [
			'cost'           => $this->faker->randomFloat(2, 15, 50),
			'payment_status' => Order::PAYMENT_STATUS_PENDING,
		];
	}

	/**
	 * Order payment status canceled state.
	 *
	 * @return \Database\Factories\OrderFactory
	 */
	public function paymentStatusCanceled(): OrderFactory
	{
		return $this->state(function () {
			return [
				'payment_status' => Order::PAYMENT_STATUS_CANCELED,
			];
		});
	}


	/**
	 * Order payment status complete state.
	 *
	 * @return \Database\Factories\OrderFactory
	 */
	public function paymentStatusComplete(): OrderFactory
	{
		return $this->state(function () {
			return [
				'payment_status' => Order::PAYMENT_STATUS_COMPLETE,
			];
		});
	}
}
