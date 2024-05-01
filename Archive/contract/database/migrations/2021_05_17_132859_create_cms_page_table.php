<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_page', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable();
            $table->text('page_content')->nullable();
            $table->string('page_slug')->nullable();
            $table->integer('status')->default(1)->comment(" 0 = InActive , 1 => Active");
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
        Schema::dropIfExists('cms_page');
    }
}
