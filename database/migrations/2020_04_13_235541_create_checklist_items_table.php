<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChecklistItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('checklist_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('checklist_id')->unsigned()->nullable()->index('checklist_items_checklists_id_fk');
			$table->string('name')->nullable();
			$table->integer('order')->nullable();
			$table->boolean('sunday')->nullable()->default(0);
			$table->boolean('monday')->nullable()->default(0);
			$table->boolean('tuesday')->nullable()->default(0);
			$table->boolean('wednesday')->nullable()->default(0);
			$table->boolean('thursday')->nullable()->default(0);
			$table->boolean('friday')->nullable()->default(0);
			$table->boolean('saturday')->nullable()->default(0);
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
		Schema::drop('checklist_items');
	}

}
