<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClientProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_product', function(Blueprint $table)
		{
			$table->foreign('client_id', 'client_product_clients_id_fk')->references('id')->on('clients')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('product_id', 'client_product_products_id_fk')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('client_product', function(Blueprint $table)
		{
			$table->dropForeign('client_product_clients_id_fk');
			$table->dropForeign('client_product_products_id_fk');
		});
	}

}
