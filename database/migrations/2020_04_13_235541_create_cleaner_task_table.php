<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCleanerTaskTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cleaner_task', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cleaner_id')->nullable()->index('cleaner_task_cleaners_id_fk');
			$table->integer('task_id')->nullable()->index('cleaner_task_tasks_id_fk');
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
		Schema::drop('cleaner_task');
	}

}
