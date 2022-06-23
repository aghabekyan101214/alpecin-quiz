<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Language;
use App\Models\Quiz;
use App\Models\QuizzesQuestion;
use Illuminate\Support\Facades\DB;

class QuizzesQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QuizzesQuestion::with('current_language', 'translations.language')->orderBy('order')->get();
        return view('admin.quizzes_questions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quizzes = Quiz::with('current_language')->get();
        $languages = Language::all();
        return view('admin.quizzes_questions.create', compact('quizzes', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        $order = QuizzesQuestion::orderBy('id', 'desc')->first()?->order ?? 0;
        DB::beginTransaction();
        $question = new QuizzesQuestion();
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
     * @param  \App\Models\QuizzesQuestion  $QuizzesQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(QuizzesQuestion $QuizzesQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuizzesQuestion  $QuizzesQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quizzes = Quiz::with('current_language')->get();
        $languages = Language::all();
        $data = QuizzesQuestion::findOrFail($id);
        return view('admin.quizzes_questions.create', compact('quizzes', 'languages', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizzesQuestion  $QuizzesQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestionRequest $request, $id)
    {
        DB::beginTransaction();
        $question = QuizzesQuestion::findOrFail($id);
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
     * @param  \App\Models\QuizzesQuestion  $QuizzesQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        QuizzesQuestion::findOrFail($id)->delete();
        session()->flash('delete-message', 'Resource has been deleted successfully.');
        return redirect(route('admin.quizzes_questions.index'));
    }

    public function sort(\Illuminate\Http\Request $request)
    {
        try{
            foreach($request->data as $d){
                QuizzesQuestion::where("id", $d["id"])->update(["order" => $d["order"]]);
            }
            session()->flash('create-message', 'You have sorted questions successfully');
        } catch (\Exception $e) {
            session()->flash('create-message', 'Something went wrong while sorting the questions.');
        }
    }
}
