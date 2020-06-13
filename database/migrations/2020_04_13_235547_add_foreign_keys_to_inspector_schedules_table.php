<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInspectorSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inspector_schedules', function(Blueprint $table)
		{
			$table->foreign('inspector_id', 'inspector_schedules_inspectors_id_fk')->references('id')->on('inspectors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('task_id', 'inspector_schedules_tasks_id_fk')->references('id')->on('tasks')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('inspector_schedules', function(Blueprint $table)
		{
			$table->dropForeign('inspector_schedules_inspectors_id_fk');
			$table->dropForeign('inspector_schedules_tasks_id_fk');
		});
	}

}
