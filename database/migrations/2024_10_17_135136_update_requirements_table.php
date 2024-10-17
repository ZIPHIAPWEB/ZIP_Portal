<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preliminary_requirements', function (Blueprint $table) {
            $table->longText('path')->nullable()->change();
        });

        Schema::table('additional_requirements', function (Blueprint $table) {
            $table->longText('path')->nullable()->change();
        });

        Schema::table('sponsor_requirements', function (Blueprint $table) {
            $table->longText('path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsor_requirements', function (Blueprint $table) {
            $table->longText('path')->change();
        });

        Schema::table('additional_requirements', function (Blueprint $table) {
            $table->longText('path')->change();
        });

        Schema::table('preliminary_requirements', function (Blueprint $table) {
            $table->longText('path')->change();
        });
    }
}
