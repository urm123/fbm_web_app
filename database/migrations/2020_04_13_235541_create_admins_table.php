<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admins', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable()->index('admins_users_id_fk');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('street_number')->nullable();
			$table->string('street_name')->nullable();
			$table->string('city')->nullable();
			$table->string('post_code', 10)->nullable();
			$table->string('telephone', 20)->nullable();
			$table->string('mobile', 20)->nullable();
			$table->dateTime('agreement_start')->nullable();
			$table->boolean('level')->nullable();
			$table->string('pan_number')->nullable();
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
		Schema::drop('admins');
	}

}
