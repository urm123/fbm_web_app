<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('role_id')->nullable();
			$table->string('name')->nullable();
			$table->string('email')->nullable();
			$table->string('username')->nullable();
			$table->string('password')->nullable();
			$table->string('role')->nullable();
			$table->string('remember_token')->nullable();
			$table->string('status', 10)->nullable()->default('ACTIVE');
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
		Schema::drop('users');
	}

}
