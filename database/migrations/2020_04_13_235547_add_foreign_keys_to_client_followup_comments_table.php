<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClientFollowupCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_followup_comments', function(Blueprint $table)
		{
			$table->foreign('admin_id', 'client_followup_comments_admins_id_fk')->references('id')->on('admins')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('client_followup_id', 'client_followup_comments_client_followups_id_fk')->references('id')->on('client_followups')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('client_followup_comments', function(Blueprint $table)
		{
			$table->dropForeign('client_followup_comments_admins_id_fk');
			$table->dropForeign('client_followup_comments_client_followups_id_fk');
		});
	}

}
