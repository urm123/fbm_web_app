<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCleanerScheduleMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cleaner_schedule_media', function(Blueprint $table)
		{
			$table->foreign('cleaner_schedule_id', 'cleaner_schedule_media_cleaner_schedules_id_fk')->references('id')->on('cleaner_schedules')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('media_id', 'cleaner_schedule_media_media_id_fk')->references('id')->on('media')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('task_item_id', 'cleaner_schedule_media_task_items_id_fk')->references('id')->on('task_items')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cleaner_schedule_media', function(Blueprint $table)
		{
			$table->dropForeign('cleaner_schedule_media_cleaner_schedules_id_fk');
			$table->dropForeign('cleaner_schedule_media_media_id_fk');
			$table->dropForeign('cleaner_schedule_media_task_items_id_fk');
		});
	}

}
