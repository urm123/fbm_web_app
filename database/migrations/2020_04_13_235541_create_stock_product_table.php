<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStockProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stock_product', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('stock_id')->nullable()->index('stock_product_stocks_id_fk');
			$table->integer('product_id')->nullable()->index('stock_product_products_id_fk');
			$table->integer('qty')->nullable();
			$table->float('price', 10, 0)->nullable();
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
		Schema::drop('stock_product');
	}

}
