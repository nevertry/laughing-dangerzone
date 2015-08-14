<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiddlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('riddles', function($table)
		{
			$table->increments('id')->unsigned();
			$table->string('type')->default('text');
			$table->longText('content')->nullable();
			$table->longText('question');
			$table->string('answer');
			$table->string('clues');
			$table->integer('publish_status')->default(0);
			$table->integer('creator_id')->nullable();
			$table->integer('editor_id')->nullable();

			$table->timestamps();
			$table->unique('id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('riddles');
	}

}
