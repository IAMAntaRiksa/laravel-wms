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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_reference_no')->unique();
            $table->enum('is_open', [1, 0])->default(0);
            $table->string('file_url')->nullable();
            $table->string('file_path')->nullable();
            $table->unsignedBigInteger('warehouse_id');
            $table->enum('type', ['main', 'area'])->default('area');
            $table->timestamps();


            $table->index('month');


            // Relationship Warehouse
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
};