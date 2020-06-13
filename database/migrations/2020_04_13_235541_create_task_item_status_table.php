<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskItemStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('task_item_status', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('task_item_id')->nullable()->index('task_item_status_task_items_id_fk');
			$table->integer('schedule_task_id')->nullable()->index('task_item_status_schedule_task_id_fk');
			$table->integer('cleaner_schedule_id')->nullable()->index('task_item_status_cleaner_schedules_id_fk');
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
		Schema::drop('task_item_status');
	}

}
