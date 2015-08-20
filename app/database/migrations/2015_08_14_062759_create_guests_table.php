<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('guests', function($table)
		{
			$table->increments('id')->unsigned();
			$table->string('email');
			$table->string('name');
			$table->integer('riddle_id')->unsigned()->nullable();
			$table->integer('status')->default(0);

			$table->timestamps();
			$table->unique('email');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('guests');
	}

}
