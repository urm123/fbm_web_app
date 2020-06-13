<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCleanerScheduleAudioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cleaner_schedule_audio', function(Blueprint $table)
		{
			$table->foreign('cleaner_schedule_id', 'cleaner_schedule_audio_cleaner_schedules_id_fk')->references('id')->on('cleaner_schedules')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cleaner_schedule_audio', function(Blueprint $table)
		{
			$table->dropForeign('cleaner_schedule_audio_cleaner_schedules_id_fk');
		});
	}

}
