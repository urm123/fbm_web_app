<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientFollowupCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_followup_comments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('client_followup_id')->nullable()->index('client_followup_comments_client_followups_id_fk');
			$table->integer('admin_id')->nullable()->index('client_followup_comments_admins_id_fk');
			$table->string('type')->nullable();
			$table->dateTime('date')->nullable();
			$table->string('upload')->nullable();
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
		Schema::drop('client_followup_comments');
	}

}
