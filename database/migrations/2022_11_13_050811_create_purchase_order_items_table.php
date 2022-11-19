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
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('qty_incoming')->default(0);
            $table->integer('qty_arrived')->default(0);
            $table->integer('incoming_plan')->default(0);

            $table->unique(['purchase_order_id', 'item_id']);
            $table->timestamps();

            // relationship purchaseOrder
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders');
            // Raltionship Item
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_order_items');
    }
};