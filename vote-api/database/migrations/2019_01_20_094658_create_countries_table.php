<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->unsignedInteger('voted');

        });

        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('voting_country');
            $table->unsignedInteger('voted_country');
            $table->unsignedInteger('points');
            $table->foreign('voting_country')->references('id')->on('countries');
            $table->foreign('voted_country')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
