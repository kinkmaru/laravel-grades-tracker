<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id')->unsigned()->unique();
            $table->string('name', 50);
            $table->decimal('section_weight', 5,2);
            $table->decimal('current_progress', 5,2);
            $table->integer('classes_id')->unsigned();
            //$table->timestamps();
        });
        Schema::table('sections', function (Blueprint $table){
            $table->foreign('classes_id')->references('id')->on('classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
