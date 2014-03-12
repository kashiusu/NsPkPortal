<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecentplayers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recentplayers', function(Blueprint $table) {
                    $table->increments('id');
                    $table->integer('summonerid');
                    $table->integer('teamid');
                    $table->string('leaguetypes_id')->foreign('leaguetypes_id')->references('id')->on('leaguetypes');
                    $table->integer('leaguechampions_id')->foreign('leaguechampions_id')->references('id')->on('leaguechampions');
                    $table->integer('recentmatch_id')->foreign('recentmatch_id')->references('id')->on('recentmatch');
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
		Schema::drop('recentplayers');
	}

}
