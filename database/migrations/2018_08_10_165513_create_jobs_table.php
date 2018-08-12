<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id')->unsigned();
            $table->string('title');
            $table->integer('category_id')->unsigned();
            $table->string('description');
            $table->integer('execution_date_id')->unsigned();

            $table->timestamps();
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('execution_date_id')->references('id')->on('execution_dates')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['execution_date_id']);
        });

        Schema::dropIfExists('jobs');
    }
}
