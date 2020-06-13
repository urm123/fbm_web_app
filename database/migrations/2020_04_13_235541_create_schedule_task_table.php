<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScheduleTaskTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schedule_task', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('schedule_id')->nullable()->index('schedule_task_schedules_id_fk');
			$table->integer('task_id')->nullable()->index('schedule_task_tasks_id_fk');
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
		Schema::drop('schedule_task');
	}

}
