<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToChecklistItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('checklist_items', function(Blueprint $table)
		{
			$table->foreign('checklist_id', 'checklist_items_checklists_id_fk')->references('id')->on('checklists')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('checklist_items', function(Blueprint $table)
		{
			$table->dropForeign('checklist_items_checklists_id_fk');
		});
	}

}
