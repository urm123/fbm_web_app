<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCleanerAlertTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cleaner_alert', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cleaner_id')->nullable()->index('cleaner_alert_cleaners_id_fk');
			$table->integer('alert_id')->nullable()->index('cleaner_alert_alerts_id_fk');
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
		Schema::drop('cleaner_alert');
	}

}
