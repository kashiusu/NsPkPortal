<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecentmatchs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recentmatchs', function(Blueprint $table) {
                    $table->increments('id');
                    $table->integer('teamid');
                    $table->integer('leaguechampions_id')->foreign('leaguechampions_id')->references('id')->on('leaguechampions');
                    $table->integer('summoners_id')->foreign('summoners_id')->references('id')->on('summoners');
                    $table->integer('spell1')->foreign('spell1')->references('id')->on('leaguespells');
                    $table->integer('spell2')->forgein('spell2')->references('id')->on('leaguespells');
                    $table->integer('recentstats_id')->foreign('recentstats_id')->references('id')->on('recentstats');
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
		Schema::drop('recentmatchs');
	}

}
