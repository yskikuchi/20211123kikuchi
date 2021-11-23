<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

class OrdersDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $orderIds = Order::pluck('id')->all();
        // $userIds = User::pluck('id')->all();
        // return [
        //     'order_id' => $orderIds[0],
        //     'user_id' => $userIds[0],
        //     'item_id'=> $this->faker->numberBetween(1,10),
        //     'quantity' => $this->faker->numberBetween(1,10),
        // ];
    }
}
