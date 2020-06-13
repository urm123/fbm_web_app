<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCleanerCheckListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cleaner_check_list_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checklist_id')->unsigned();
            $table->string('name')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('checklist_id')->references('id')->on('cleaner_check_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cleaner_check_list_items');
    }
}
