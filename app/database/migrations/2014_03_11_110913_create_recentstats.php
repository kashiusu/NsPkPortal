<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecentstats extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recentstats', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('goldEarned');
                $table->integer('championsKilled');
                $table->integer('numDeaths');
                $table->integer('assists');
                $table->integer('minionsKilled');
                $table->boolean('win');
                $table->integer('item0');
                $table->integer('item1');
                $table->integer('item2');
                $table->integer('item3');
                $table->integer('item4');
                $table->integer('item5');
                $table->integer('item6');
                $table->integer('recentmatchs_id')->foreign('recentmatchs_id')->references('id')->on('recentmatchs');
                $table->timestamp('timePlayed');
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
		Schema::drop('recentstats');
	}

}
