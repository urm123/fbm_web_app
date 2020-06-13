<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInspectorSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inspector_schedules', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('inspector_id')->nullable()->index('inspector_schedules_inspectors_id_fk');
			$table->integer('task_id')->nullable()->index('inspector_schedules_tasks_id_fk');
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
		Schema::drop('inspector_schedules');
	}

}
