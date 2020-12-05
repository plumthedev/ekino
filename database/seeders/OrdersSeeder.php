<?php

namespace Database\Seeders;

use App\Models\Cinematography;
use App\Models\Order;
use App\Models\User;
use Database\Factories\OrderFactory;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createUserOrders();
    }

    /**
     * Create orders by user.
     *
     * @return void
     */
    protected function createUserOrders(): void
    {
        $ordersAmount = mt_rand(15, 30);

        for ($i = 0; $i < $ordersAmount; $i++) {
            $user = $this->findRandomUser();
            $cinematography = $this->findRandomCinematography();

            $user->orders()->create(array_merge($this->getOrderAttributes(), [
                'cinematography_id' => $cinematography->id,
                'cost'              => $cinematography->subscriptionPlan->price,
                'access_duration'   => $cinematography->subscriptionPlan->access_duration,
            ]));
        }
    }

    /**
     * Find random user from database.
     *
     * @return \App\Models\User
     */
    protected function findRandomUser(): User
    {
        return User::inRandomOrder()->first();
    }

    /**
     * Find random cinematography from database.
     *
     * @return \App\Models\Cinematography
     */
    protected function findRandomCinematography(): Cinematography
    {
        return Cinematography::inRandomOrder()->first();
    }


    /**
     * Get order base attributes.
     *
     * @return array
     */
    protected function getOrderAttributes(): array
    {
        return $this->orderFactory()->makeOne()->getAttributes();
    }


    /**
     * Get order factory.
     *
     * @return \Database\Factories\OrderFactory
     */
    protected function orderFactory(): OrderFactory
    {
        return Order::factory();
    }
}
