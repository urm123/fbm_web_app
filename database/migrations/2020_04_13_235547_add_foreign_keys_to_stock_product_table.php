<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToStockProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('stock_product', function(Blueprint $table)
		{
			$table->foreign('product_id', 'stock_product_products_id_fk')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('stock_id', 'stock_product_stocks_id_fk')->references('id')->on('stocks')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('stock_product', function(Blueprint $table)
		{
			$table->dropForeign('stock_product_products_id_fk');
			$table->dropForeign('stock_product_stocks_id_fk');
		});
	}

}
