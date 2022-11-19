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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('mr_no');
            $table->unsignedBigInteger('logistic_id');
            $table->enum('type', ['DN', 'STO'])->default('DN');
            $table->string('unique_code')->unique();
            $table->string('project_id')->nullable();
            $table->string('project_name')->nullable();
            $table->string('object_id')->nullable();
            $table->string('delivery_to')->nullable();
            $table->string('delivery_from')->nullable();
            $table->string('mr_type')->nullable();
            $table->string('site_name')->nullable();
            $table->string('link_id')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('mode_of_delivery')->nullable();
            $table->string('mode_of_transportation')->nullable();
            $table->string('total_colly')->nullable();
            $table->string('weight_all_material')->nullable();
            $table->enum('status', ['Pending', 'Packed', 'Ready To Ship', 'In Shipment', 'Received', 'Done'])->default('Pending');
            $table->string('receiver_name')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->string('receiver_signature_url')->nullable();
            $table->string('receiver_signature_path')->nullable();
            $table->string('evidence_url')->nullable();
            $table->string('evidence_path')->nullable();
            $table->unsignedBigInteger('requested_by')->nullable();
            $table->unsignedBigInteger('checked_by')->nullable();
            $table->unsignedBigInteger('packed_by')->nullable();
            $table->unsignedBigInteger('delivered_by')->nullable();
            $table->string('date')->nullable();
            $table->timestamps();
            $table->string('month')->nullable();
            $table->string('year')->nullable();

            // $table->index('status');
            // $table->index('month');
            // $table->index('year');

            // Relationship Logistic
            $table->foreign('logistic_id')->references('id')->on('logistics');

            // Relationship User
            $table->foreign('requested_by')->references('id')->on('users');
            $table->foreign('checked_by')->references('id')->on('users');
            $table->foreign('packed_by')->references('id')->on('users');
            $table->foreign('delivered_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
};