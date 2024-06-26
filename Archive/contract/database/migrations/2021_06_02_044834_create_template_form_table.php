<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_form', function (Blueprint $table) {
            $table->id();
            $table->integer('contract_id');
            $table->integer('template_id');
            $table->text('label')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->text('meta')->nullable();
            $table->integer('is_required')->default(0)->comment(" 0 = InActive , 1 => Active");
            $table->integer('status')->default(1)->comment(" 0 = InActive , 1 => Active");
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
        Schema::dropIfExists('template_form');
    }
}
