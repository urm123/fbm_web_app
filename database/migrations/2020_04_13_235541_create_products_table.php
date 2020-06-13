<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->nullable();
			$table->string('product_code')->nullable();
			$table->float('price', 10, 0)->nullable();
			$table->integer('qty')->nullable();
			$table->string('type')->nullable();
			$table->string('units')->nullable();
			$table->string('description')->nullable();
			$table->boolean('available')->nullable()->default(1);
			$table->integer('shortage_alert')->nullable();
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
		Schema::drop('products');
	}

}
