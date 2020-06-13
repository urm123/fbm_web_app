<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAccountingContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('accounting_contacts', function(Blueprint $table)
		{
			$table->foreign('client_id', 'accounting_contacts_clients_id_fk')->references('id')->on('clients')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('accounting_contacts', function(Blueprint $table)
		{
			$table->dropForeign('accounting_contacts_clients_id_fk');
		});
	}

}
