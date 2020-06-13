<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProspectCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prospect_comments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('prospect_id')->nullable()->index('prospect_comments_prospects_id_fk');
			$table->integer('admin_id')->nullable()->index('prospect_comments_admins_id_fk');
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
		Schema::drop('prospect_comments');
	}

}
