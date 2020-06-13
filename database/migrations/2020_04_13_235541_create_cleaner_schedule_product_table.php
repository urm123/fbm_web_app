<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCleanerScheduleProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cleaner_schedule_product', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('product_id')->nullable()->index('cleaner_schedule_product_products_id_fk');
			$table->integer('cleaner_schedule_id')->nullable()->index('cleaner_schedule_product_cleaner_schedules_id_fk');
			$table->integer('quantity')->nullable();
			$table->dateTime('date')->nullable();
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
		Schema::drop('cleaner_schedule_product');
	}

}
