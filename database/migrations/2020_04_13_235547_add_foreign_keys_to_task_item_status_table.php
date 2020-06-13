<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTaskItemStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('task_item_status', function(Blueprint $table)
		{
			$table->foreign('cleaner_schedule_id', 'task_item_status_cleaner_schedules_id_fk')->references('id')->on('cleaner_schedules')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('schedule_task_id', 'task_item_status_schedule_task_id_fk')->references('id')->on('schedule_task')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('task_item_id', 'task_item_status_task_items_id_fk')->references('id')->on('task_items')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('task_item_status', function(Blueprint $table)
		{
			$table->dropForeign('task_item_status_cleaner_schedules_id_fk');
			$table->dropForeign('task_item_status_schedule_task_id_fk');
			$table->dropForeign('task_item_status_task_items_id_fk');
		});
	}

}
