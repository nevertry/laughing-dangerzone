<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharmapsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('charmaps', function($table)
		{
			$table->increments('id')->unsigned();
			$table->string('letter');
			$table->string('symbol');

			$table->timestamps();
			$table->unique('letter');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('charmaps');
	}

}
