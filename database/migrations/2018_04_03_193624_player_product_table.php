<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlayerProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_product', function (Blueprint $table) {
         $table->integer('player_id')->unsigned()->nullable();
         $table->foreign('player_id')->references('id')->on('players');
         $table->integer('product_id')->unsigned()->nullable();
         $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::table('player_product', function (Blueprint $table) {
            //
        });
    }
}
