<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('vToken')->nullable()->change();
            $table->boolean('verified')->default(false)->change();
            $table->boolean('isOnline')->default(false)->change();
            $table->boolean('isFilled')->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('vToken')->change();
            $table->boolean('verified')->change();
            $table->boolean('isOnline')->change();
            $table->boolean('isFilled')->change();
        });
    }
}
