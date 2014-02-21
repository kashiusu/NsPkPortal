<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChampionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('leaguechampions', function(Blueprint $table) {
                $table->integer('id')->primary();
                $table->string('name', 50);
                $table->integer('w');
                $table->integer('h');
                $table->integer('y');
                $table->integer('x');
                $table->string('sprite');
                
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('leaguechampions');
	}

}
