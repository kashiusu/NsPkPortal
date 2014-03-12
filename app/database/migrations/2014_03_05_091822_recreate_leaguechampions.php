<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RecreateLeaguechampions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leaguechampions', function(Blueprint $table) {
			$table->integer('id')->primary();
			$table->string('name');
                        $table->string('group');
                        $table->string('image');
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
		Schema::drop('leaguechampions');
	}

}
