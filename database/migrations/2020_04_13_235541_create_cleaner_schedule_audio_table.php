<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCleanerScheduleAudioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cleaner_schedule_audio', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cleaner_schedule_id')->nullable()->index('cleaner_schedule_audio_cleaner_schedules_id_fk');
			$table->dateTime('date')->nullable();
			$table->string('audio')->nullable();
			$table->boolean('notification')->nullable()->default(1);
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
		Schema::drop('cleaner_schedule_audio');
	}

}
