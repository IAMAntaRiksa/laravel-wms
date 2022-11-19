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
        Schema::create('delivery_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delivery_id');
            $table->string('order_reference_no')->nullable();
            $table->unsignedBigInteger('item_id');
            $table->integer('qty');
            $table->enum('is_manual', [1, 0])->default(0);
            $table->string('sloc')->nullable();
            $table->string('unit')->nullable();
            $table->timestamps();

            // relationship delivery
            $table->foreign('delivery_id')->references('id')->on('deliveries');

            // relationship item
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
        Schema::dropIfExists('delivery_items');
    }
};