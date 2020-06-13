<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChecklistItemFeedbackMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('checklist_item_feedback_media', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('checklist_item_feedback_id')->unsigned()->nullable()->index('checklist_item_feedback_media_checklist_item_feedbacks_id_fk');
			$table->integer('media_id')->nullable()->index('checklist_item_feedback_media_media_id_fk');
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
		Schema::drop('checklist_item_feedback_media');
	}

}
