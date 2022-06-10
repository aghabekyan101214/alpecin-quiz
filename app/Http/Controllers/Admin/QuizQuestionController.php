<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Language;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Question\Question;

class QuizQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QuizQuestion::with('translations')->get();
        return view('admin.quizzess_questions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quizzes = Quiz::with('translations')->get();
        $languages = Language::all();
        return view('admin.quizzess_questions.create', compact('quizzes', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        $order = QuizQuestion::orderBy('id', 'desc')->first()?->order ?? 0;
        DB::beginTransaction();
        $question = new QuizQuestion();
        $question->order = $order + 1;
        $question->quiz_id = $request->quiz_id;
        $question->save();
        $question->translations()->createMany($request->data);
        DB::commit();

        session()->flash('create-message', 'Resource has been created successfully.');
        return redirect(route('admin.quizzes_questions.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(QuizQuestion $quizQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quizzes = Quiz::with('translations')->get();
        $languages = Language::all();
        $data = QuizQuestion::findOrFail($id);
        return view('admin.quizzess_questions.create', compact('quizzes', 'languages', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestionRequest $request, $id)
    {
        DB::beginTransaction();
        $question = QuizQuestion::findOrFail($id);
        foreach ($request->data as $d) {
            if($question->translations()->where('language_id', $d["language_id"])->exists()) {
                $question->translations()->where('language_id', $d["language_id"])->update($d);
            } else {
                $question->translations()->createMany([$d]);
            }
        }
        DB::commit();

        session()->flash('update-message', 'Resource has been updated successfully.');
        return redirect(route('admin.quizzes_questions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        QuizQuestion::findOrFail($id)->delete();
        session()->flash('delete-message', 'Resource has been deleted successfully.');
        return redirect(route('admin.quizzes_questions.index'));
    }
}
