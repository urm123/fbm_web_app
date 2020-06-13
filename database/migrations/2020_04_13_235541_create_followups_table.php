<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFollowupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('followups', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('client_id')->nullable()->index('followups_clients_id_fk');
			$table->integer('inspector_id')->nullable()->index('followups_inspectors_id_fk');
			$table->integer('admin_id')->nullable()->index('followups_admins_id_fk');
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
		Schema::drop('followups');
	}

}
