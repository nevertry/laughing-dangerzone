<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiddlesAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('riddles_answers', function($table)
		{
			$table->increments('id')->unsigned();
			$table->integer('guest_id')->unsigned();
			$table->integer('riddle_id')->unsigned();
			$table->string('answer');
			$table->integer('status')->unsigned()->default(0);

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
		Schema::drop('riddles_answers');
	}

}
