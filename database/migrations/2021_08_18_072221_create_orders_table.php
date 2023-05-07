<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->integer('country_id');
            $table->integer('user_id');
            $table->string('payment_method_global');
            $table->integer('recipient_id')->nullable();
            $table->integer('reason_id')->nullable();
            $table->integer('service_id');
            $table->integer('payment_method_id');
            $table->decimal('amount', 8, 2);
            $table->decimal('recipient_amount', 8, 2);
            $table->decimal('grand_total', 8, 2);
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
