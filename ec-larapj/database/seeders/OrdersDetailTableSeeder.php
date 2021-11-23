<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrdersDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderIds = Order::pluck('id')->all();
        DB::table('orders_details')->insert([
            'user_id' => 1,
            'order_id' => $orderIds[0],
            'item_id' => 1,
            'quantity' => 1
        ]);
        DB::table('orders_details')->insert([
            'user_id' => 1,
            'order_id' => $orderIds[0],
            'item_id' => 2,
            'quantity' => 2
        ]);
        DB::table('orders_details')->insert([
            'user_id' => 1,
            'order_id' => $orderIds[1],
            'item_id' => 3,
            'quantity' => 3
        ]);
        DB::table('orders_details')->insert([
            'user_id' => 2,
            'order_id' => $orderIds[2],
            'item_id' => 4,
            'quantity' => 1
        ]);
        DB::table('orders_details')->insert([
            'user_id' => 2,
            'order_id' => $orderIds[3],
            'item_id' => 5,
            'quantity' => 1
        ]);
        DB::table('orders_details')->insert([
            'user_id' => 2,
            'order_id' => $orderIds[3],
            'item_id' => 6,
            'quantity' => 2
        ]);
        DB::table('orders_details')->insert([
            'user_id' => 3,
            'order_id' => $orderIds[4],
            'item_id' => 7,
            'quantity' => 2
        ]);
        DB::table('orders_details')->insert([
            'user_id' => 3,
            'order_id' => $orderIds[5],
            'item_id' => 8,
            'quantity' => 1
        ]);
    }
}
