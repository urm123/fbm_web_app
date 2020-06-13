<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('task_items', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('task_id')->nullable()->index('task_items_tasks_id_fk');
			$table->string('name', 1000)->nullable();
			$table->boolean('checked')->nullable()->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('task_items');
	}

}
