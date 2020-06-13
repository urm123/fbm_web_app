<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFeedbackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('feedback', function(Blueprint $table)
		{
			$table->foreign('cleaner_id', 'feedback_cleaners_a_id_fk')->references('id')->on('cleaners')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('inspector_id', 'feedback_inspectors_a_id_fk')->references('id')->on('inspectors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('task_id', 'feedback_tasks_a_id_fk')->references('id')->on('tasks')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('task_id', 'feedback_tasks_id_fk')->references('id')->on('tasks')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('feedback', function(Blueprint $table)
		{
			$table->dropForeign('feedback_cleaners_a_id_fk');
			$table->dropForeign('feedback_inspectors_a_id_fk');
			$table->dropForeign('feedback_tasks_a_id_fk');
			$table->dropForeign('feedback_tasks_id_fk');
		});
	}

}
