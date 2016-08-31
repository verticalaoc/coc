<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clans', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('tag');
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('warFrequency')->nullable();
            $table->string('badgeUrlsLarge')->nullable();
            $table->string('badgeUrlsMedium')->nullable();
            $table->string('badgeUrlsSmall')->nullable();
            $table->string('locationId')->nullable();
            $table->string('locationName')->nullable();
            $table->boolean('locationIsCountry')->nullable();
            $table->string('locationCountryCode')->nullable();
            $table->integer('members')->nullable();
            $table->integer('warWinStreak')->nullable();
            $table->integer('requiredTrophies')->nullable();
            $table->integer('warWins')->nullable();
            $table->integer('clanPoints')->nullable();
            $table->integer('clanLevel')->nullable();
            $table->boolean('isWarLogPublic')->nullable();
            $table->integer('donations')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clans');
    }
}
