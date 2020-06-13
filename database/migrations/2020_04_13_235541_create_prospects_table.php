<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProspectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prospects', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('telephone')->nullable();
			$table->string('mobile')->nullable();
			$table->string('address')->nullable();
			$table->string('email')->nullable();
			$table->string('reference')->nullable();
			$table->string('status')->nullable();
			$table->string('sq_footage')->nullable();
			$table->string('quote')->nullable();
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
		Schema::drop('prospects');
	}

}
