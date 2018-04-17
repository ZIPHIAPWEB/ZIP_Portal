<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('birthdate');
            $table->string('gender');
            $table->text('address');
            $table->string('home_number');
            $table->string('mobile_number');
            $table->text('school');
            $table->string('year');
            $table->string('course');
            $table->string('skype_id');
            $table->string('program_id_no');
            $table->string('sevis_id');
            $table->string('host_company_id');
            $table->string('position');
            $table->string('location');
            $table->string('stipend');
            $table->string('fb_email');
            $table->string('visa_interview_status');
            $table->string('program_start_date');
            $table->string('program_end_date');
            $table->string('visa_sponsor_id');
            $table->string('date_of_departure');
            $table->string('date_of_arrival');
            $table->string('application_id');
            $table->string('program_id');
            $table->string('application_status');
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
        Schema::dropIfExists('students');
    }
}
