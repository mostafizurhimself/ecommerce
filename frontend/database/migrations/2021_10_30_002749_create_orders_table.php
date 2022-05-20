<?php

use App\Enums\OrderStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->index('order_invoice_no_index');
            $table->bigInteger('customer_id')->unsigned();
            $table->double('sub_total')->default(0);
            $table->double('total_discount')->default(0);
            $table->double('grand_total')->default(0);
            $table->string('note')->nullable();
            $table->string('payment_method');
            $table->string('status')->default(OrderStatus::PENDING());
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}