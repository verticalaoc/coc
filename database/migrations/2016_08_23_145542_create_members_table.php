<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('tag');
            $table->string('clanId');
            $table->string('name')->nullable();
            $table->string('role')->nullable();
            $table->integer('expLevel')->nullable();
            $table->integer('trophies')->nullable();
            $table->integer('clanRank')->nullable();
            $table->integer('previousClanRank')->nullable();
            $table->integer('donations')->nullable();
            $table->integer('donationsReceived')->nullable();

            // flatten from 'league'
            $table->integer('leagueId')->nullable();
            $table->string('leagueName')->nullable();
            $table->string('leagueIconUrlsSmall')->nullable();
            $table->string('leagueIconUrlsTiny')->nullable();
            $table->string('leagueIconUrlsMedium')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('members');
    }
}
