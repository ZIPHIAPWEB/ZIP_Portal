<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year');
            $table->string('program');
            $table->string('total');
            $table->integer('new_applicant');
            $table->integer('assessed');
            $table->integer('confirmed');
            $table->integer('hired');
            $table->integer('for_visa_interview');
            $table->integer('visa_approved');
            $table->integer('visa_denied');
            $table->integer('cancel');
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
        Schema::dropIfExists('summaries');
    }
}
