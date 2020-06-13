<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCleanersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cleaners', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable()->index('cleaners_users_id_fk');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('telephone', 20)->nullable();
			$table->string('mobile', 20)->nullable();
			$table->string('street_number')->nullable();
			$table->string('street_name')->nullable();
			$table->string('city')->nullable();
			$table->string('post_code', 10)->nullable();
			$table->dateTime('start_date')->nullable();
			$table->boolean('type')->nullable()->default(1);
			$table->string('pan_number', 10)->nullable();
			$table->string('image')->nullable();
			$table->string('initial_password')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->string('termination')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cleaners');
	}

}
