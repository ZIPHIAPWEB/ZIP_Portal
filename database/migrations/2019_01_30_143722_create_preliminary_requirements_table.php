<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreliminaryRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preliminary_requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_id')->unsigned();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->longText('path')->nullable();
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
        Schema::dropIfExists('preliminary_requirements');
    }
}
