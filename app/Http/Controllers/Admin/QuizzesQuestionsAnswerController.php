<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuizzesQuestionsAnswersRequest;
use App\Models\Language;
use App\Models\QuizzesQuestion;
use App\Models\QuizzesQuestionsAnswer;
use Illuminate\Support\Facades\DB;

class QuizzesQuestionsAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QuizzesQuestionsAnswer::with('current_language', 'question', 'translations.language')->orderBy('quizzes_questions_id')->get();
        return view('admin.quizzes_questions_answers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = QuizzesQuestion::with('current_language')->get();
        $languages = Language::all();
        return view('admin.quizzes_questions_answers.create', compact('questions', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuizzesQuestionsAnswersRequest $request)
    {
        DB::beginTransaction();
        $answer = new QuizzesQuestionsAnswer();
        $answer->quizzes_questions_id = $request->quizzes_questions_id;
        $answer->save();
        $answer->translations()->createMany($request->data);
        DB::commit();

        session()->flash('create-message', 'Resource has been created successfully.');
        return redirect(route('admin.quizzes_questions_answers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuizzesQuestionsAnswer  $quizzesQuestionsAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(QuizzesQuestionsAnswer $quizzesQuestionsAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuizzesQuestionsAnswer  $quizzesQuestionsAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizzesQuestionsAnswer $quizzesQuestionsAnswer)
    {
        $questions = QuizzesQuestion::with('current_language')->get();
        $languages = Language::all();
        $data = $quizzesQuestionsAnswer;
        return view('admin.quizzes_questions_answers.create', compact('questions', 'languages', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizzesQuestionsAnswer  $quizzesQuestionsAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuizzesQuestionsAnswersRequest $request, QuizzesQuestionsAnswer $quizzesQuestionsAnswer)
    {
        DB::beginTransaction();

        foreach ($request->data as $d) {
            if($quizzesQuestionsAnswer->translations()->where('language_id', $d["language_id"])->exists()) {
                $quizzesQuestionsAnswer->translations()->where('language_id', $d["language_id"])->update($d);
            } else {
                $quizzesQuestionsAnswer->translations()->createMany([$d]);
            }
        }
        DB::commit();

        session()->flash('update-message', 'Resource has been updated successfully.');
        return redirect(route('admin.quizzes_questions_answers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizzesQuestionsAnswer  $quizzesQuestionsAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizzesQuestionsAnswer $quizzesQuestionsAnswer)
    {
        $quizzesQuestionsAnswer->delete();
        session()->flash('delete-message', 'Resource has been deleted successfully.');
        return redirect(route('admin.quizzes_questions_answers.index'));
    }
}
