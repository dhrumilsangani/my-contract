<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmendAgreementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amend_agreement', function (Blueprint $table) {
            $table->id();
            $table->integer('contract_data_id')->nullable();
            $table->enum('amend_agreement', array('yes','no'));
            $table->text('amend_header')->nullable();
            $table->text('amend_content')->nullable();
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
        Schema::dropIfExists('amend_agreement');
    }
}
