<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('type', 45)->nullable();
            $table->bigInteger('addressable_id')->unsigned();
            $table->string('addressable_type');
            $table->text('street')->nullable();
            $table->string('city')->nullable()->index('address_city_index');
            $table->string('state')->nullable()->index('address_state_index');
            $table->string('country')->index('address_country_index');
            $table->string('zipcode')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}