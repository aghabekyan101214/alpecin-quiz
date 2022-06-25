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
        Schema::create('quizzes_users_states', function (Blueprint $table) {
            $table->id();
            $table->string("session_id", 100)->unique();

            $table->unsignedBigInteger("question_id");
            $table->foreign("question_id")->references("id")->on("quizzes_questions")->onDelete("cascade");


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
        Schema::dropIfExists('quizzes_users_states');
    }
};
