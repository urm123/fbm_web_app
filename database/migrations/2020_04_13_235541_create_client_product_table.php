<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_product', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('client_id')->nullable()->index('client_product_clients_id_fk');
			$table->integer('product_id')->nullable()->index('client_product_products_id_fk');
			$table->integer('quantity')->nullable();
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
		Schema::drop('client_product');
	}

}
