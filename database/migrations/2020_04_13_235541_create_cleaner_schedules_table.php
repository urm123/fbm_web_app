<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCleanerSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cleaner_schedules', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cleaner_id')->nullable()->index('cleaner_schedules_cleaners_id_fk');
			$table->integer('task_id')->nullable()->index('cleaner_schedules_tasks_id_fk');
			$table->dateTime('start_time')->nullable();
			$table->dateTime('end_time')->nullable();
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
		Schema::drop('cleaner_schedules');
	}

}
