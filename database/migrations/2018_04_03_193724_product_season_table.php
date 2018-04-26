<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductSeasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_season', function (Blueprint $table) {
         $table->integer('product_id')->unsigned()->nullable();
         $table->foreign('product_id')->references('id')->on('products');
         $table->integer('season_id')->unsigned()->nullable();
         $table->foreign('season_id')->references('id')->on('seasons');
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
        Schema::table('product_season', function (Blueprint $table) {
            //
        });
    }
}
