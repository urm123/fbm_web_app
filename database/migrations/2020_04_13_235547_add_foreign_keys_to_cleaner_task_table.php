<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCleanerTaskTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cleaner_task', function(Blueprint $table)
		{
			$table->foreign('cleaner_id', 'cleaner_task_cleaners_id_fk')->references('id')->on('cleaners')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('task_id', 'cleaner_task_tasks_id_fk')->references('id')->on('tasks')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cleaner_task', function(Blueprint $table)
		{
			$table->dropForeign('cleaner_task_cleaners_id_fk');
			$table->dropForeign('cleaner_task_tasks_id_fk');
		});
	}

}
