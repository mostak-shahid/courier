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
            $table->string('receiver_email')->nullable();
            $table->string('receiver_address');
            $table->string('destination_location');
            $table->unsignedBigInteger('product_price');
            $table->unsignedBigInteger('product_quantity');
            $table->unsignedBigInteger('product_weight');
            $table->longText('product_description');
            $table->string('product_packaging_type');
            $table->longText('special_instructions')->nullable();
            $table->string('delivery_type');
            $table->boolean('cod')->default('0');
            $table->unsignedBigInteger('payable_amount')->nullable()->default('0');
            $table->unsignedBigInteger('received_amount')->nullable()->default('0');
            $table->date('delivery_date')->nullable()->default('0000-00-00');
            $table->string('payment_status')->nullable()->default('Unpaid');
            $table->date('payment_date')->nullable()->default('0000-00-00');
            $table->string('payment_method')->nullable();
            $table->unsignedBigInteger('pickup_bill')->nullable()->default('0');
            $table->unsignedBigInteger('delivery_bill')->nullable()->default('0');
            $table->foreignId('pickup_by')->nullable();
            $table->foreignId('deliver_by')->nullable();
            $table->string('delivery_status')->nullable()->default('Pending');
            $table->unsignedBigInteger('delivery_charge')->nullable()->default('0');
            $table->unsignedBigInteger('urgent_delivery_charge')->nullable()->default('0');
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
