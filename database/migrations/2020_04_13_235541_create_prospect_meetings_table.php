<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProspectMeetingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prospect_meetings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('prospect_id')->nullable()->index('prospect_meetings_prospects_id_fk');
			$table->dateTime('date')->nullable();
			$table->string('description')->nullable();
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
		Schema::drop('prospect_meetings');
	}

}
