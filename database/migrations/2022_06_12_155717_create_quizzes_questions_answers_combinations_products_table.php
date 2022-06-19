<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes_questions_answers_combinations_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quizzes_questions_answers_combination_id');
            $table->foreign('quizzes_questions_answers_combination_id', 'qqap_answer_comb_fk')->references('id')->on('quizzes_questions_answers_combinations')->onDelete('cascade');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'qqap_product_id_fk')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('quizzes_questions_answers_combinations_products');
    }
};
