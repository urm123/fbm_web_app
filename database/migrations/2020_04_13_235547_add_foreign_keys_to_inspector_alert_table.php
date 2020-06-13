<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInspectorAlertTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inspector_alert', function(Blueprint $table)
		{
			$table->foreign('alert_id', 'inspector_alert_alerts_id_fk')->references('id')->on('alerts')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('inspector_id', 'inspector_alert_inspectors_id_fk')->references('id')->on('inspectors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('inspector_alert', function(Blueprint $table)
		{
			$table->dropForeign('inspector_alert_alerts_id_fk');
			$table->dropForeign('inspector_alert_inspectors_id_fk');
		});
	}

}
