<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRiddlesPools extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('riddles_pools', function($table)
		{
			$table->increments('id')->unsigned();
			$table->integer('pool_id')->unsigned()->nullable();
			$table->integer('riddle_id')->unsigned()->nullable();
			$table->integer('guest_id')->unsigned()->nullable();
			$table->integer('status')->default(0);

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
		Schema::drop('riddles_pools');
	}

}
