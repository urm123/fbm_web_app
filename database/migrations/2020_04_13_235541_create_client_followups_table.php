<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientFollowupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_followups', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('client_id')->nullable()->index('client_followups_clients_id_fk');
			$table->integer('admin_id')->nullable()->index('client_followups_admins_id_fk');
			$table->integer('task_id')->nullable();
			$table->string('type')->nullable();
			$table->string('comment')->nullable();
			$table->dateTime('date')->nullable();
			$table->string('status')->nullable();
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
		Schema::drop('client_followups');
	}

}
