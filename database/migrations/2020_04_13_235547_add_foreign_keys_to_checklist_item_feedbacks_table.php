<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToChecklistItemFeedbacksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('checklist_item_feedbacks', function(Blueprint $table)
		{
			$table->foreign('checklist_item_id', 'checklist_item_feedbacks_checklist_items_id_fk')->references('id')->on('checklist_items')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('inspector_schedule_id', 'checklist_item_feedbacks_inspector_schedules_id_fk')->references('id')->on('inspector_schedules')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('inspector_id', 'checklist_item_feedbacks_inspectors_id_fk')->references('id')->on('inspectors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('task_id', 'checklist_item_feedbacks_tasks_id_fk')->references('id')->on('tasks')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('checklist_item_feedbacks', function(Blueprint $table)
		{
			$table->dropForeign('checklist_item_feedbacks_checklist_items_id_fk');
			$table->dropForeign('checklist_item_feedbacks_inspector_schedules_id_fk');
			$table->dropForeign('checklist_item_feedbacks_inspectors_id_fk');
			$table->dropForeign('checklist_item_feedbacks_tasks_id_fk');
		});
	}

}
