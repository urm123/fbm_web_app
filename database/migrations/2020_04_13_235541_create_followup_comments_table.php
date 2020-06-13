<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFollowupCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('followup_comments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('followup_id')->nullable()->index('followup_comments_followups_id_fk');
			$table->integer('admin_id')->nullable()->index('followup_comments_admins_id_fk');
			$table->integer('inspector_id')->nullable()->index('followup_comments_inspectors_id_fk');
			$table->string('upload')->nullable();
			$table->dateTime('date')->nullable();
			$table->string('comment')->nullable();
			$table->string('description')->nullable();
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
		Schema::drop('followup_comments');
	}

}
