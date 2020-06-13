<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComplaintsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('complaints', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('ticket')->nullable();
			$table->integer('cleaner_id')->nullable()->index('complaints_cleaners_id_fk');
			$table->integer('task_id')->nullable()->index('complaints_tasks_id_fk');
			$table->integer('inspector_id')->nullable()->index('complaints_inspectors_id_fk');
			$table->date('date')->nullable();
			$table->text('complaint', 65535)->nullable();
			$table->string('upload')->nullable();
			$table->string('type')->nullable();
            $table->string('inspector_status')->nullable();
			$table->boolean('resolved')->nullable()->default(0);
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
		Schema::drop('complaints');
	}

}
