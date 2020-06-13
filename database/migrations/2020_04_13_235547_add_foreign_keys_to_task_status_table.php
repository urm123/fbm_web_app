<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTaskStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('task_status', function(Blueprint $table)
		{
			$table->foreign('cleaner_schedule_id', 'task_status_cleaner_schedules_id_fk')->references('id')->on('cleaner_schedules')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('schedule_task_id', 'task_status_schedule_task_id_fk')->references('id')->on('schedule_task')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('task_status', function(Blueprint $table)
		{
			$table->dropForeign('task_status_cleaner_schedules_id_fk');
			$table->dropForeign('task_status_schedule_task_id_fk');
		});
	}

}
