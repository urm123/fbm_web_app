<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCleanerTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cleaner_times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->integer('cleaner_id');
            $table->foreign('cleaner_id')->references('id')->on('cleaners')->onDelete('cascade');
            $table->integer('client_sub_id')->nullable();
            $table->foreign('client_sub_id')->references('id')->on('clients')->onDelete('cascade');
            $table->integer('work_days')->nullable();
            $table->string('work_date')->nullable();
            $table->string('time')->nullable();
            $table->string('mobile')->nullable();
            $table->string('telephone')->nullable();
            $table->string('number_of_people')->nullable();
            $table->string('time_in')->nullable();
            $table->string('time_out')->nullable();
            $table->string('total')->nullable();
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
        Schema::dropIfExists('cleaner_times');
    }
}
