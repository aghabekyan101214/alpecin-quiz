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
        Schema::create('quizzes_used_depending_questions', function (Blueprint $table) {
            $table->id();
            $table->string("session_id", 100);
            $table->unsignedBigInteger("depending_question_id");
            $table->foreign("depending_question_id")->references("id")->on("depending_questions")->onDelete("cascade");
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
        Schema::dropIfExists('quizzes_used_depending_questions');
    }
};
