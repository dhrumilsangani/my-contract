<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_data', function (Blueprint $table) {
            $table->id();
            $table->string('contract_name')->nullable();
            $table->integer('template_id')->nullable();
            $table->integer('contract_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('one_coontract_status')->nullable();
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
        Schema::dropIfExists('contract_data');
    }
}
