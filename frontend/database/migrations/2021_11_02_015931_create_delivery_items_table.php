<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryItemsTable extends Migration
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
            $table->bigInteger('delivery_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->double('quantity')->default(0);
            $table->double('rate')->default(0);
            $table->bigInteger('unit_id')->unsigned();
            $table->double('amount')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('delivery_id')->references('id')->on('deliveries')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units');
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
}