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
            $table->foreignId('user_id');
            $table->string('business_name');
            $table->string('business_phone');
            $table->string('business_address');
            $table->string('pickup_location');
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->string('receiver_address');
            $table->string('destination_location');
            $table->unsignedBigInteger('product_price');
            $table->unsignedBigInteger('product_quantity');
            $table->unsignedBigInteger('product_weight');
            $table->longText('product_description');
            $table->string('product_packaging_type');
            $table->longText('special_instructions')->nullable();
            $table->boolean('cod');
            $table->unsignedBigInteger('payable_amount')->default('0');
            $table->unsignedBigInteger('received_amount')->nullable()->default('0');
            $table->date('delivery_date');
            $table->string('payment_status');
            $table->date('payment_date');
            $table->string('payment_method');
            $table->unsignedBigInteger('pickup_charge');
            $table->unsignedBigInteger('delivery_charge');
            $table->foreignId('pickup_by');
            $table->foreignId('deliver_by');
            $table->string('delivery_status');
            $table->unsignedBigInteger('delivery_charge');
            $table->unsignedBigInteger('urgent_delivery_charge');
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
