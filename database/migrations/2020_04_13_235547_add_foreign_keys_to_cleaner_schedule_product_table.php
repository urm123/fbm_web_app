<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCleanerScheduleProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cleaner_schedule_product', function(Blueprint $table)
		{
			$table->foreign('cleaner_schedule_id', 'cleaner_schedule_product_cleaner_schedules_id_fk')->references('id')->on('cleaner_schedules')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('product_id', 'cleaner_schedule_product_products_id_fk')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cleaner_schedule_product', function(Blueprint $table)
		{
			$table->dropForeign('cleaner_schedule_product_cleaner_schedules_id_fk');
			$table->dropForeign('cleaner_schedule_product_products_id_fk');
		});
	}

}
