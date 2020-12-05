<?php

namespace Database\Factories;

use App\Models\Access;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Access::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'key'    => Access::generateKey(),
            'status' => $this->faker->randomElement([
                Access::STATUS_ALLOWED,
                Access::STATUS_DENIED,
            ]),
        ];
    }

    /**
     * Access for order with status payment canceled.
     *
     * @return \Database\Factories\AccessFactory
     */
    public function orderPaymentStatusCanceled(): AccessFactory
    {
        return $this->state([
            'status' => Access::STATUS_DENIED,
        ]);
    }

    /**
     * Access for order with status payment complete.
     *
     * @param \App\Models\Order $order
     *
     * @return \Database\Factories\AccessFactory
     */
    public function orderPaymentStatusComplete(Order $order): AccessFactory
    {
        $attributes = [
            'status' => Access::STATUS_ALLOWED,
        ];

        if ($this->faker->boolean) {
            $now = now();

            $attributes = array_merge($attributes, [
                'started_at' => $now,
                'ended_at'   => $now->copy()->addHours(
                    $order->access_duration
                ),
            ]);
        }

        return $this->state($attributes);
    }

    /**
     * Access for order with status payment pending.
     *
     *
     * @return \Database\Factories\AccessFactory
     */
    public function orderPaymentStatusPending(): AccessFactory
    {
        return $this->state([
            'status' => Access::STATUS_DENIED,
        ]);
    }
}
