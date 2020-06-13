<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQueryLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('query_log', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('sql')->nullable();
			$table->string('bindings')->nullable();
			$table->string('time')->nullable();
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
		Schema::drop('query_log');
	}

}
