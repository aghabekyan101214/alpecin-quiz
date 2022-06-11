<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_languages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('restrict');

            $table->string('name', 255);
            $table->tinyText('description')->nullable();

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
        Schema::dropIfExists('products_languages');
    }
}
