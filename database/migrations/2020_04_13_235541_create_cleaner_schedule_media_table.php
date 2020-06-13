<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCleanerScheduleMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cleaner_schedule_media', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('media_id')->nullable()->index('cleaner_schedule_media_media_id_fk');
			$table->integer('cleaner_schedule_id')->nullable()->index('cleaner_schedule_media_cleaner_schedules_id_fk');
			$table->integer('task_item_id')->nullable()->index('cleaner_schedule_media_task_items_id_fk');
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
		Schema::drop('cleaner_schedule_media');
	}

}
