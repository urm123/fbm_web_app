<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('task_status', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cleaner_schedule_id')->nullable()->index('task_status_cleaner_schedules_id_fk');
			$table->integer('schedule_task_id')->nullable()->index('task_status_schedule_task_id_fk');
			$table->string('status')->nullable();
			$table->dateTime('date')->nullable();
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
		Schema::drop('task_status');
	}

}
