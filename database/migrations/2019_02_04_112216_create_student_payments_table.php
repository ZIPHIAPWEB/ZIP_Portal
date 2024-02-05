<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('requirement_id')->unsigned();
            $table->string('bank_code');
            $table->string('reference_no');
            $table->string('date_deposit');
            $table->string('bank_account_no');
            $table->string('amount');
            $table->boolean('status');
            $table->boolean('acknowledgement');
            $table->longText('path');
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
        Schema::dropIfExists('student_payments');
    }
}
