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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipment_id');
            $table->foreign('shipment_id')->references('id')->on('shipments')->onDelete('cascade');
            $table->string('name');
            $table->integer('quantity')->default(1);
            $table->integer('weight');
            $table->string('weight_unit')->default('kg');
            $table->string('custom_value')->nullable();
            $table->string('x_axis')->default(1);
            $table->string('y_axis')->default(1);
            $table->string('z_axis')->default(1);
            $table->string('dimension_unit')->default('cm');
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
        Schema::dropIfExists('items');
    }
};
