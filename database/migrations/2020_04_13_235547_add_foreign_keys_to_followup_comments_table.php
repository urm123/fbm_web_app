<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFollowupCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('followup_comments', function(Blueprint $table)
		{
			$table->foreign('admin_id', 'followup_comments_admins_id_fk')->references('id')->on('admins')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('followup_id', 'followup_comments_followups_id_fk')->references('id')->on('followups')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('inspector_id', 'followup_comments_inspectors_id_fk')->references('id')->on('inspectors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('followup_comments', function(Blueprint $table)
		{
			$table->dropForeign('followup_comments_admins_id_fk');
			$table->dropForeign('followup_comments_followups_id_fk');
			$table->dropForeign('followup_comments_inspectors_id_fk');
		});
	}

}
