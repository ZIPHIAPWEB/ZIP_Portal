<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveFieldOnRequirementsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preliminary_requirements', function (Blueprint $table) {
            $table->boolean('is_active')->after('path')->default(1);
        });

        Schema::table('additional_requirements', function (Blueprint $table) {
            $table->boolean('is_active')->after('path')->default(1);
        });

        Schema::table('payment_requirements', function (Blueprint $table) {
            $table->boolean('is_active')->after('description')->default(1);
        });

        Schema::table('sponsor_requirements', function (Blueprint $table) {
            $table->boolean('is_active')->after('description')->default(1);
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
            $table->dropColumn('is_active');
        });

        Schema::table('payment_requirements', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('additional_requirements', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('preliminary_requirements', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
