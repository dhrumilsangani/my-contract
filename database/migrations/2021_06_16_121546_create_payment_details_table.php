<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->decimal('amount', 12,2)->nullable();
            $table->string("type")->nullable();
            $table->string("transaction_id")->nullable();
            $table->string("transaction_status")->nullable();
            $table->string("payment_session_id")->nullable();
            $table->string("payment_type")->nullable();
            $table->string("currency")->nullable();
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
        Schema::dropIfExists('payment_details');
    }
}
