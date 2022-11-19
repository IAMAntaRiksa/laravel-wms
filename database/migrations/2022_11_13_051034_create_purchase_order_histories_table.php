<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_item_id');
            $table->integer('qty');
            $table->enum('action', ['incoming', 'arrived']);
            $table->timestamps();

            // relationship purchaseOrderItem
            $table->foreign('purchase_order_item_id')->references('id')->on('purchase_order_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_order_histories');
    }
};