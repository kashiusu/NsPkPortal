<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChampiondatas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('championdatas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('totalDeathsPerSession');
                        $table->integer('totalSessionsPlayed');
                        $table->integer("totalDamageTaken");
                        $table->integer("totalQuadraKills");
                        $table->integer("totalTripleKills");
                        $table->integer("totalMinionKills");
                        $table->integer("maxChampionsKilled");
                        $table->integer("totalDoubleKills");
                        $table->integer("totalPhysicalDamageDealt");
                        $table->integer("totalChampionKills");
                        $table->integer("totalAssists");
                        $table->integer("mostChampionKillsPerSession");
                        $table->integer("totalDamageDealt");
                        $table->integer("totalFirstBlood");
                        $table->integer("totalSessionsLost");
                        $table->integer("totalSessionsWon");
                        $table->integer("totalMagicDamageDealt");
                        $table->integer("totalGoldEarned");
                        $table->integer("totalPentaKills");
                        $table->integer("totalTurretsKilled");
                        $table->integer("mostSpellsCast");
                        $table->integer("maxNumDeaths");
                        $table->integer("totalUnrealKills");
                        $table->integer('leaguechampions_id')->foreign('leaguechampions_id')->references('id')->on('leaguechampions');
                        $table->integer('summoners_id')->foreign('summoners_id')->references('id')->on('summoners');
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
		Schema::drop('championdatas');
	}

}
