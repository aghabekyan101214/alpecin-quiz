<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizesQuestionsLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes_questions_languages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('quiz_question_id');
            $table->foreign('quiz_question_id')->references('id')->on('quiz_questions')->onDelete('cascade');

            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('restrict');

            $table->string('question', 255);

            $table->unique(['quiz_question_id', 'language_id']);

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
        Schema::dropIfExists('quizzes_questions_languages');
    }
}