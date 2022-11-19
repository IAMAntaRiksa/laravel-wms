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
        Schema::create('material_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->string('no_picking')->nullable();
            $table->string('project_id')->nullable();
            $table->string('project_name')->nullable();
            $table->string('mr_no')->nullable();
            $table->string('mr_date')->nullable();
            $table->string('status_mr_header')->nullable();
            $table->string('remarks')->nullable();
            $table->string('object_id')->nullable();
            $table->string('object_type')->nullable();
            $table->string('object_parent_id')->nullable();
            $table->string('object_parent_type')->nullable();
            $table->string('project_definition')->nullable();
            $table->string('wbs_element')->nullable();
            $table->string('order')->nullable();
            $table->string('site_id_ne')->nullable();
            $table->string('site_name')->nullable();
            $table->string('link_id')->nullable();
            $table->string('network')->nullable();
            $table->string('ne_fe')->nullable();
            $table->string('im_no')->nullable();
            $table->string('order_reference_no')->nullable();
            $table->string('status_sn')->nullable();
            $table->string('order_qty')->nullable();
            $table->string('unit')->nullable();
            $table->string('system_config')->nullable();
            $table->string('storage_location')->nullable();
            $table->string('type')->nullable();
            $table->string('functional_location')->nullable();
            $table->string('description')->nullable();
            $table->string('purpose')->nullable();
            $table->string('delivery_from')->nullable();
            $table->string('delivery_to')->nullable();
            $table->string('region')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('propinsi')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('eta')->nullable();
            $table->string('plan_mode_of_delivery')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('prepared_by')->nullable();
            $table->string('dr_no')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('lot')->nullable();
            $table->string('etd')->nullable();
            $table->string('dn_no')->nullable();
            $table->string('sto_no')->nullable();
            $table->string('boq_no')->nullable();
            $table->timestamps();
            $table->string('month');

            // $table->index('mr_no');
            // $table->index('month');


            // Relationship Item
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
        Schema::dropIfExists('material_requests');
    }
};