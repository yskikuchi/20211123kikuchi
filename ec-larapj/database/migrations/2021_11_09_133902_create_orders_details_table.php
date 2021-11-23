<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_details', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->uuid('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->foreignId('item_id')->constrained('items');
            $table->integer('quantity');
            $table->timestamps();

            $table->unique(['order_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_details');
    }
}
