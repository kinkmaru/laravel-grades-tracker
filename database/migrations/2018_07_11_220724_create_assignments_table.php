<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id')->unsigned()->unique();
            $table->string('name', 50);
            $table->decimal('max_score', 5,2);
            $table->decimal('achieved_score', 5,2);
            $table->decimal('grade', 5,2);
            $table->decimal('assignment_weight', 5,2);
            $table->decimal('weighted_grade', 5,2);
            $table->integer('section_id')->unsigned();
            //$table->timestamps();
        });
        Schema::table('assignments', function (Blueprint $table){
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}
