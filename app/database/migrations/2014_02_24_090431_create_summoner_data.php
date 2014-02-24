<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSummonerData extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW summoner_data AS '
                        . 'SELECT S.id as sum_id, S.name as Sum_name, L.leaguename, L.tier, L.rank, L.lp, L.wins, L.losses, T.id as leag_type, T.name as leag_name '
                        . 'FROM summoners as S, leagues as L, leaguetypes as T '
                        . 'WHERE S.id = L.summoners_id '
                        . 'AND T.id = L.leaguetypes_id');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW summoner_data');
	}

}
