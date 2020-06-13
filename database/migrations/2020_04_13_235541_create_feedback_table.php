<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeedbackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feedback', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('task_id')->nullable()->index('feedback_tasks_id_fk');
			$table->integer('cleaner_id')->nullable()->index('feedback_cleaners_id_fk');
			$table->integer('inspector_id')->nullable()->index('feedback_inspectors_id_fk');
			$table->text('feedback', 65535)->nullable();
			$table->integer('rating')->nullable();
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
		Schema::drop('feedback');
	}

}
