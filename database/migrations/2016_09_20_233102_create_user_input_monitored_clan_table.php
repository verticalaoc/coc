<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInputMonitoredClanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userInputMonitoredClans', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('tag');
            $table->string('name');
            $table->index('tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('userInputMonitoredClans');
    }
}
