<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'namespace' => "App\Http\Controllers\Admin", "as" => "admin.", "middleware" => "auth:web"], function () {
    Route::get('/', 'AdminController@index')->name('dashboard');

    Route::resource('quizzes', 'QuizController')->names('quizzes');
//    Route::resource('languages', 'LanguageController')->names('languages');
    Route::resource('quizzes-questions', 'QuizzesQuestionController')->names('quizzes_questions');
    Route::post('quizzes-questions-sort', 'QuizzesQuestionController@sort')->name('quizzes_questions_sor');
    Route::resource('quizzes-questions-answers', 'QuizzesQuestionsAnswerController')->names('quizzes_questions_answers');
    Route::resource('products', 'ProductController')->names('products');
    Route::resource('combinations', 'QuizzesQuestionsAnswersCombinationController')->names('combinations');
    Route::resource('depending-questions', 'DependingQuestionController')->names('depending_questions');
});


Route::group(['namespace' => "App\Http\Controllers\Client", 'prefix' => '{lang?}', 'middleware' => 'setlocale', 'where' => ['lang' => '[a-zA-Z]{2}']], function() {
    Route::get("/", "QuizController@index")->name("index");
    Route::group(["as" => "quiz.", "prefix" => "quiz", "middleware" => "check_passed_quiz"], function () {
        Route::get("/{session_id}", "QuizController@get_question")->name("get_question");
        Route::post("/start", "QuizController@start")->name("start");
        Route::post("/answer-question", "QuizController@answer_question")->name("answer_question");
    });
    Route::get("quiz/{session_id}/result", "QuizController@quiz_result")->name("quiz.quiz_result");
});
