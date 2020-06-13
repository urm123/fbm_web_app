<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInspectorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inspectors', function(Blueprint $table)
		{
			$table->foreign('user_id', 'inspectors_users_id_fk')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('inspectors', function(Blueprint $table)
		{
			$table->dropForeign('inspectors_users_id_fk');
		});
	}

}
