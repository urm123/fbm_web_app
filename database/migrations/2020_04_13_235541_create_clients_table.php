<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_id')->unsigned()->nullable()->index('clients_categories_id_fk');
			$table->string('name')->nullable();
			$table->string('street_number')->nullable();
			$table->string('street_name')->nullable();
			$table->string('city')->nullable();
			$table->string('post_code')->nullable();
			$table->boolean('continuous')->nullable()->default(1);
			$table->boolean('supply_required')->nullable()->default(0);
			$table->date('termination_date')->nullable();
			$table->date('start_date')->nullable();
			$table->string('lock_code')->nullable();
			$table->string('alarm_code')->nullable();
			$table->date('payment')->nullable();
			$table->string('contract')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clients');
	}

}
