<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterWilayahTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('master_wilayah', function($table)
		{
			$table->increments('id');
			$table->string('code');
			$table->string('name');
			$table->longText('description');
			$table->integer('parent_id');
			$table->integer('level');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('master_wilayah');
	}

}
