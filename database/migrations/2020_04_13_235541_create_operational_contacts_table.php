<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOperationalContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('operational_contacts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('client_id')->nullable()->index('operational_contacts_clients_id_fk');
			$table->string('first_name')->nullable();
			$table->string('email')->nullable();
			$table->string('telephone')->nullable();
			$table->string('post_code')->nullable();
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
		Schema::drop('operational_contacts');
	}

}
