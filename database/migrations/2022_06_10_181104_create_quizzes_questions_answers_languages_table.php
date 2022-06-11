<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesQuestionsAnswersLanguagesTable extends Migration
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
            $table->unsignedBigInteger('quizzes_questions_answers_id');
            $table->foreign('quizzes_questions_answers_id', 'quizzes_questions_answers_id_fk')->references('id')->on('quizzes_questions_answers')->onDelete('cascade');

            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('restrict');

            $table->string('answer', 255);

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
        Schema::dropIfExists('quizzes_questions_answers_languages');
    }
}
