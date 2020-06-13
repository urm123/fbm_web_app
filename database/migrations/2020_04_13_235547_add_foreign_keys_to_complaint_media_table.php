<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComplaintMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('complaint_media', function(Blueprint $table)
		{
			$table->foreign('complaint_id', 'complaint_media_complaints_id_fk')->references('id')->on('complaints')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('media_id', 'complaint_media_media_id_fk')->references('id')->on('media')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('complaint_media', function(Blueprint $table)
		{
			$table->dropForeign('complaint_media_complaints_id_fk');
			$table->dropForeign('complaint_media_media_id_fk');
		});
	}

}
