<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProspectCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('prospect_comments', function(Blueprint $table)
		{
			$table->foreign('admin_id', 'prospect_comments_admins_id_fk')->references('id')->on('admins')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('prospect_id', 'prospect_comments_prospects_id_fk')->references('id')->on('prospects')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('prospect_comments', function(Blueprint $table)
		{
			$table->dropForeign('prospect_comments_admins_id_fk');
			$table->dropForeign('prospect_comments_prospects_id_fk');
		});
	}

}
