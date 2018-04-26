<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ItemProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_product', function (Blueprint $table) {
           $table->integer('item_id')->unsigned()->nullable();
           $table->foreign('item_id')->references('id')->on('items');
           $table->integer('product_id')->unsigned()->nullable();
           $table->foreign('product_id')->references('id')->on('products');
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
        Schema::table('item_product', function (Blueprint $table) {
            //
        });
    }
}
