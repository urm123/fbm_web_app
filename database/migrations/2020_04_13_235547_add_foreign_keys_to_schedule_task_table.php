<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToScheduleTaskTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('schedule_task', function(Blueprint $table)
		{
			$table->foreign('schedule_id', 'schedule_task_schedules_id_fk')->references('id')->on('schedules')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('task_id', 'schedule_task_tasks_id_fk')->references('id')->on('tasks')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('schedule_task', function(Blueprint $table)
		{
			$table->dropForeign('schedule_task_schedules_id_fk');
			$table->dropForeign('schedule_task_tasks_id_fk');
		});
	}

}
