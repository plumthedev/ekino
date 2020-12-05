<?php

namespace Database\Seeders;

use App\Models\Access;
use App\Models\Order;
use Database\Factories\AccessFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use InvalidArgumentException;

class AccessesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createOrdersAccess();
    }

    /**
     * Crate access from orders.
     *
     * @return void
     */
    protected function createOrdersAccess(): void
    {
        foreach (Order::all() as $order) {
            $this->createAccessFromOrder($order);
        }
    }

    /**
     * Create access from single order.
     *
     * @param \App\Models\Order $order
     *
     * @return \App\Models\Access
     */
    protected function createAccessFromOrder(Order $order): Access
    {
        return $order->access()->create(
            $this->composeAccessAttributesFromOrder($order)
        );
    }

    /**
     * Compose access attributes from order.
     *
     * @param \App\Models\Order $order
     *
     * @return array
     */
    protected function composeAccessAttributesFromOrder(Order $order): array
    {
        $attributes = [
            'user_id'           => $order->user_id,
            'order_id'          => $order->id,
            'cinematography_id' => $order->cinematography_id,
        ];

        $factoryMethodName = "order_payment_status_{$order->payment_status}";
        $factoryMethodName = Str::lower($factoryMethodName);
        $factoryMethodName = Str::studly($factoryMethodName);

        if (!method_exists($this->accessFactory(), $factoryMethodName)) {
            throw new InvalidArgumentException(
                sprintf('Cannot find access factory method for order with payment status [%s].', $order->payment_status)
            );
        }

        $model = $this->accessFactory()->$factoryMethodName($order);
        $attributes = array_merge(
            $attributes,
            $model->makeOne()->attributesToArray()
        );

        return $attributes;
    }

    /**
     * Access factory.
     *
     * @return \Database\Factories\AccessFactory
     */
    public function accessFactory(): AccessFactory
    {
        return Access::factory();
    }
}
