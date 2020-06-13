<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComplaintsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('complaints', function(Blueprint $table)
		{
			$table->foreign('cleaner_id', 'complaints_cleaners_id_fk')->references('id')->on('cleaners')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('inspector_id', 'complaints_inspectors_id_fk')->references('id')->on('inspectors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('task_id', 'complaints_tasks_id_fk')->references('id')->on('tasks')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('complaints', function(Blueprint $table)
		{
			$table->dropForeign('complaints_cleaners_id_fk');
			$table->dropForeign('complaints_inspectors_id_fk');
			$table->dropForeign('complaints_tasks_id_fk');
		});
	}

}
