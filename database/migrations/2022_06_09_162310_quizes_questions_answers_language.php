<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuizesQuestionsAnswersLanguage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes_questions_answers_languages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('quiz_question_answer_id');
            $table->foreign('quiz_question_answer_id', 'quiz_question_answer_id_fk')->references('id')->on('quiz_question_answers')->onDelete('cascade');

            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('restrict');

            $table->string('question', 255);

            $table->unique(['quiz_question_answer_id', 'language_id'], 'question_language_unique');

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
        //
    }
}
