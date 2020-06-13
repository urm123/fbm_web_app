<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComplaintFollowupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('complaint_followups', function(Blueprint $table)
		{
			$table->foreign('admin_id', 'complaint_followups_admins_id_fk')->references('id')->on('admins')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('complaint_id', 'complaint_followups_complaints_id_fk')->references('id')->on('complaints')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('inspector_id', 'complaint_followups_inspectors_id_fk')->references('id')->on('inspectors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('complaint_followups', function(Blueprint $table)
		{
			$table->dropForeign('complaint_followups_admins_id_fk');
			$table->dropForeign('complaint_followups_complaints_id_fk');
			$table->dropForeign('complaint_followups_inspectors_id_fk');
		});
	}

}
