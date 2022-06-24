<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDependingQuestionRequest;
use App\Models\DependingQuestion;
use App\Models\Language;
use App\Models\QuizzesQuestion;
use App\Models\QuizzesQuestionsAnswer;
use Illuminate\Http\Request;

class DependingQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DependingQuestion::with('question', 'answer')->get();
        return view('admin.depending-questions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        $questions = QuizzesQuestion::with('current_language')->get();
        $answers = QuizzesQuestionsAnswer::with('current_language')->get();
        return view('admin.depending-questions.create', compact('languages', 'questions', 'answers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDependingQuestionRequest $request)
    {
        $dependingQuestion = new DependingQuestion();
        $dependingQuestion->question_id = $request->question_id;
        $dependingQuestion->answer_id = $request->answer_id;
        $dependingQuestion->save();

        session()->flash('create-message', 'Resource has been created successfully.');
        return redirect(route('admin.depending_questions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DependingQuestion  $dependingQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(DependingQuestion $dependingQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DependingQuestion  $dependingQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(DependingQuestion $dependingQuestion)
    {
        $languages = Language::all();
        $questions = QuizzesQuestion::with('current_language')->get();
        $answers = QuizzesQuestionsAnswer::with('current_language')->get();
        $data = $dependingQuestion;
        return view('admin.depending-questions.create', compact('languages', 'questions', 'answers', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DependingQuestion  $dependingQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDependingQuestionRequest $request, DependingQuestion $dependingQuestion)
    {
        $dependingQuestion->question_id = $request->question_id;
        $dependingQuestion->answer_id = $request->answer_id;
        $dependingQuestion->save();

        session()->flash('update-message', 'Resource has been updated successfully.');
        return redirect(route('admin.depending_questions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DependingQuestion  $dependingQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(DependingQuestion $dependingQuestion)
    {
        $dependingQuestion->delete();
        session()->flash('delete-message', 'Resource has been delete successfully.');
        return redirect(route('admin.depending_questions.index'));
    }
}
