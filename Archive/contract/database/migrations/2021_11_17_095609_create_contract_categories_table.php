<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_categories', function (Blueprint $table) {
            $table->id();
            $table->string('categories_name')->nullable();
            $table->string('image')->after('categories_name')->nullable();
            $table->integer('status')->default(1)->comment(" 0 = InActive , 1 => Active");
            $table->softDeletes();
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
        Schema::dropIfExists('contract_categories');
    }
}
