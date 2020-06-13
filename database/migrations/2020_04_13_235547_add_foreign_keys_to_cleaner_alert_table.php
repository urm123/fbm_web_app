<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCleanerAlertTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cleaner_alert', function(Blueprint $table)
		{
			$table->foreign('alert_id', 'cleaner_alert_alerts_id_fk')->references('id')->on('alerts')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('cleaner_id', 'cleaner_alert_cleaners_id_fk')->references('id')->on('cleaners')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cleaner_alert', function(Blueprint $table)
		{
			$table->dropForeign('cleaner_alert_alerts_id_fk');
			$table->dropForeign('cleaner_alert_cleaners_id_fk');
		});
	}

}
