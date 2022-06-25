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
        Schema::create('quizzes_users_feedback', function (Blueprint $table) {
            $table->id();
            $table->string("session_id", 100);
            $table->unsignedBigInteger("combination_id");
            $table->foreign("combination_id")->references("id")->on("quizzes_questions_answers_combinations")->onDelete("cascade");
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
        Schema::dropIfExists('quizzes_users_feedback');
    }
};
