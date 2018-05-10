<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductSizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_size', function (Blueprint $table) {
           $table->integer('product_id')->unsigned()->nullable();
           $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
           $table->integer('size_id')->unsigned()->nullable();
           $table->foreign('size_id')->references('id')->on('sizes');
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
        Schema::table('product_size', function (Blueprint $table) {
            //
        });
    }
}
