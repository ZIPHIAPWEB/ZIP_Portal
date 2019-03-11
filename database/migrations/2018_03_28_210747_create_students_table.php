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
            $table->text('permanent_address');
            $table->text('provincial_address');
            $table->string('home_number');
            $table->string('mobile_number');
            $table->string('year');
            $table->string('skype_id');
            $table->string('program_id_no')->nullable();
            $table->string('sevis_id')->nullable();
            $table->string('host_company_id')->nullable();
            $table->string('position')->nullable();
            $table->string('location')->nullable();
            $table->string('stipend')->nullable();
            $table->string('fb_email');
            $table->string('visa_interview_status')->nullable();
            $table->date('program_start_date')->nullable();
            $table->date('program_end_date')->nullable();
            $table->string('visa_sponsor_id')->nullable();

            $table->date('us_departure_date')->nullable();
            $table->time('us_departure_time')->nullable();
            $table->string('us_departure_flight_no')->nullable();
            $table->string('us_departure_airline')->nullable();
            $table->date('us_arrival_date')->nullable();
            $table->time('us_arrival_time')->nullable();
            $table->string('us_arrival_flight_no')->nullable();
            $table->string('us_arrival_airline')->nullable();

            $table->date('mnl_departure_date')->nullable();
            $table->time('mnl_departure_time')->nullable();
            $table->string('mnl_departure_flight_no')->nullable();
            $table->string('mnl_departure_airline')->nullable();
            $table->date('mnl_arrival_date')->nullable();
            $table->time('mnl_arrival_time')->nullable();
            $table->string('mnl_arrival_flight_no')->nullable();
            $table->string('mnl_arrival_airline')->nullable();

            $table->string('application_id')->nullable();
            $table->string('program_id');
            $table->string('application_status')->nullable();
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
