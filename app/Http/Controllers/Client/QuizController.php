<?php


namespace App\Http\Controllers\Client;


use App\Models\Language;
use Illuminate\Http\Request;

class QuizController
{
    public function start(Request $request)
    {
        return view('quiz.start');
    }
}
