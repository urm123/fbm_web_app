<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChecklistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('checklists', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id')->unsigned()->nullable()->index('checklists_categories_categories_fk');
			$table->string('title')->nullable();
			$table->integer('order')->unsigned()->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('checklists');
	}

}
