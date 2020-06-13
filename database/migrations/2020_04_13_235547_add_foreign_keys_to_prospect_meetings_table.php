<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProspectMeetingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('prospect_meetings', function(Blueprint $table)
		{
			$table->foreign('prospect_id', 'prospect_meetings_prospects_id_fk')->references('id')->on('prospects')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('prospect_meetings', function(Blueprint $table)
		{
			$table->dropForeign('prospect_meetings_prospects_id_fk');
		});
	}

}
