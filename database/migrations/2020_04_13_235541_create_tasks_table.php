<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->nullable();
			$table->integer('client_id')->nullable()->index('tasks_clients_id_fk');
			$table->string('address')->nullable();
			$table->string('latitude')->nullable();
			$table->string('longitude')->nullable();
			$table->string('type')->nullable();
			$table->string('status')->nullable()->default('ACTIVE');
			$table->boolean('notification')->nullable()->default(1);
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
		Schema::drop('tasks');
	}

}
