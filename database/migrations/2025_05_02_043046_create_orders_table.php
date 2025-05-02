<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('shipper_name');
            $table->string('shipper_tlp');
            $table->string('shipper_address');
            $table->string('recipient_name');
            $table->string('recipient_tlp');
            $table->string('recipient_address');
            $table->string('courier_company');
            $table->string('tracking_id');
            $table->string('waybill_id');
            $table->string('item_name');
            $table->string('item_desc');
            $table->integer('item_qty');
            $table->integer('item_value');
            $table->integer('item_weight');
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
