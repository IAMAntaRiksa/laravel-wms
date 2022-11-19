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
        Schema::create('delivery_item_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delivery_id');
            $table->enum('status', ['Pending', 'Packed', 'ReadyToShip', 'InShipment', 'Received', 'Done'])->default('Pending');
            $table->unsignedBigInteger('action_by');
            $table->timestamps();

            // Relationship delivery
            $table->foreign('delivery_id')->references('id')->on('deliveries');
            // Relationship User
            $table->foreign('action_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_item_histories');
    }
};