<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToChecklistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('checklists', function(Blueprint $table)
		{
			$table->foreign('category_id', 'checklists_categories_categories_fk')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('checklists', function(Blueprint $table)
		{
			$table->dropForeign('checklists_categories_categories_fk');
		});
	}

}
