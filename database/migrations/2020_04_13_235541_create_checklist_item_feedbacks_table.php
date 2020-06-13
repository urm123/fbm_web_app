<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChecklistItemFeedbacksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('checklist_item_feedbacks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('checklist_item_id')->unsigned()->nullable()->index('checklist_item_feedbacks_checklist_items_id_fk');
			$table->integer('inspector_id')->nullable()->index('checklist_item_feedbacks_inspectors_id_fk');
			$table->integer('task_id')->nullable()->index('checklist_item_feedbacks_tasks_id_fk');
			$table->integer('inspector_schedule_id')->nullable()->index('checklist_item_feedbacks_inspector_schedules_id_fk');
			$table->integer('feedback')->unsigned()->nullable();
			$table->string('audio')->nullable();
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
		Schema::drop('checklist_item_feedbacks');
	}

}
