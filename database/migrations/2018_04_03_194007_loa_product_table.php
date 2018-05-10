<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoaProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loa_product', function (Blueprint $table) {
           $table->integer('loa_id')->unsigned()->nullable();
           $table->foreign('loa_id')->references('id')->on('loas');
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
        Schema::table('loa_product', function (Blueprint $table) {
            //
        });
    }
}
