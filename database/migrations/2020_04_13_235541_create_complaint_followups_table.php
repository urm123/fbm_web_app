<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComplaintFollowupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('complaint_followups', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('complaint_id')->nullable()->index('complaint_followups_complaints_id_fk');
			$table->integer('inspector_id')->nullable()->index('complaint_followups_inspectors_id_fk');
			$table->integer('admin_id')->nullable()->index('complaint_followups_admins_id_fk');
			$table->string('comment')->nullable();
			$table->string('description')->nullable();
			$table->string('upload')->nullable();
			$table->dateTime('date')->nullable();
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
		Schema::drop('complaint_followups');
	}

}
