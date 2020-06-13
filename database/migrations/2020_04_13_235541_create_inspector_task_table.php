<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInspectorTaskTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inspector_task', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('task_id')->nullable()->index('inspector_task_tasks_id_fk');
			$table->integer('inspector_id')->nullable()->index('inspector_task_inspectors_id_fk');
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
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
		Schema::drop('inspector_task');
	}

}
