<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInspectorAlertTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inspector_alert', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('inspector_id')->nullable()->index('inspector_alert_inspectors_id_fk');
			$table->integer('alert_id')->nullable()->index('inspector_alert_alerts_id_fk');
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
		Schema::drop('inspector_alert');
	}

}
