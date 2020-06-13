<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComplaintMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('complaint_media', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('complaint_id')->nullable()->index('complaint_media_complaints_id_fk');
			$table->integer('media_id')->nullable()->index('complaint_media_media_id_fk');
			$table->string('type')->nullable()->default('image');
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
		Schema::drop('complaint_media');
	}

}
