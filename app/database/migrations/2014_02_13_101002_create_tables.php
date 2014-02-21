<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{   
            Schema::create('summoners', function(Blueprint $table) {
                $table->integer('id')->primary();
                $table->string('name', 50);
                $table->string('tier');
                $table->string('rank');
                $table->string('lp');
                $table->string('wins');
                $table->DateTime('lastupdate');
            });
                
            Schema::create('permission', function($table)
            {
                $table->increments('id');
                $table->string('label');
            });
            
            Schema::create('users', function($table)
            {
                $table->increments('id');
                $table->string('email')->unique();
                $table->string('name');
                $table->string('password');
                $table->integer('summoners_id')->foreign('summoners_id')->references('id')->on('summoners');
                $table->integer('permission_id')->foreign('permission_id')->references('id')->on('permission');
            });   
            
            Schema::create('post', function($table)
            {
                $table->increments('id');
                $table->text('description');
                $table->string('lien');
                $table->integer('users_id')->foreign('users_id')->references('id')->on('users');
            });
            
            Schema::create('comment', function($table){
               $table->increments('id');
               $table->text('text');
               $table->integer('post_id')->foreign('post_id')->references('id')->on('post');
               $table->integer('users_id')->foreign('users_id')->references('id')->on('users');
            });
            
            Schema::create('note', function($table){
                $table->increments('id');
                $table->integer('plus');
                $table->integer('users_id')->foreign('users_id')->references('id')->on('users');
                $table->integer('post_id')->foreign('post_id')->references('id')->on('post');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('note','comment','post','users','permission','summoners');
	}

}
