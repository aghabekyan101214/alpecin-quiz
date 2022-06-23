<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuizRequest;
use App\Models\Language;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Quiz::with('current_language', 'translations.language')->get();
        return view('admin.quizzes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        return view('admin.quizzes.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuizRequest $request)
    {
        DB::beginTransaction();

        $quiz = new Quiz();
        $quiz->save();

        $quiz->translations()->createMany($request->data);

        DB::commit();

        session()->flash('create-message', 'Resource has been created successfully.');
        return redirect(route('admin.quizzes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        $languages = Language::all();
        $data = $quiz;
        return view('admin.quizzes.create', compact('languages', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuizRequest $request, Quiz $quiz)
    {
        DB::beginTransaction();

        foreach ($request->data as $d) {
            if($quiz->translations()->where('language_id', $d["language_id"])->exists()) {
                $quiz->translations()->where('language_id', $d["language_id"])->update($d);
            } else {
                $quiz->translations()->createMany([$d]);
            }
        }

        session()->flash('update-message', 'Resource has been updated successfully.');
        DB::commit();

        return redirect(route('admin.quizzes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        session()->flash('delete-message', 'Resource has been updated successfully.');
        return redirect(route('admin.quizzes.index'));
    }
}
