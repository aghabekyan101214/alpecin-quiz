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
    Route::resource('languages', 'LanguageController')->names('languages');
    Route::resource('quizzes-questions', 'QuizzesQuestionController')->names('quizzes_questions');
    Route::post('quizzes-questions-sort', 'QuizzesQuestionController@sort')->name('quizzes_questions_sor');
    Route::resource('quizzes-questions-answers', 'QuizzesQuestionsAnswerController')->names('quizzes_questions_answers');
    Route::resource('products', 'ProductController')->names('products');
});
