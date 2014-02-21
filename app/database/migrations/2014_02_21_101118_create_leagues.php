<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeagues extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leagues', function(Blueprint $table) {
                        $table->increments('id');
                        $table->string('leaguename');
			$table->string('tier');
                        $table->string('rank');
                        $table->integer('lp');
                        $table->string('wins');
                        $table->string('losses');
                        $table->integer('summoners_id')->foreign('summoners_id')->references('id')->on('summoners');
                        $table->integer('leaguetypes_id')->foreign('leaguetypes_id')->references('id')->on('leaguetypes');
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
		Schema::drop('leagues');
	}

}
