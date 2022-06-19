<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCombinationRequest;
use App\Models\Product;
use App\Models\QuizzesQuestion;
use App\Models\QuizzesQuestionsAnswersCombination;
use Illuminate\Support\Facades\DB;

class QuizzesQuestionsAnswersCombinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QuizzesQuestionsAnswersCombination::with(["answers", "products"])->get();
        return view('admin.combinations.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = QuizzesQuestion::with('answers.translations', 'translations')->get();
        $products = Product::all();
        return view('admin.combinations.create', compact('questions', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCombinationRequest $request)
    {
        DB::beginTransaction();

        $comb = new QuizzesQuestionsAnswersCombination();
        $comb->name = $request->name;
        $comb->save();
        $answer_ids = [];
        foreach ($request->answer_ids as $id) {
            if (!is_null($id)) $answer_ids[]["quizzes_questions_answer_id"] = $id;
        }
        $product_ids = [];
        foreach ($request->product_ids as $p) {
            $product_ids[]["product_id"] = $p;
        }
        $comb->answers()->createMany($answer_ids);
        $comb->products()->createMany($product_ids);

        DB::commit();

        session()->flash('create-message', 'Resource has been created successfully.');
        return redirect(route("admin.combinations.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuizzesQuestionsAnswersCombination  $quizzesQuestionsAnswersCombination
     * @return \Illuminate\Http\Response
     */
    public function show(QuizzesQuestionsAnswersCombination $quizzesQuestionsAnswersCombination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuizzesQuestionsAnswersCombination  $quizzesQuestionsAnswersCombination
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = QuizzesQuestionsAnswersCombination::with('products', 'answers')->findOrFail($id);
        $questions = QuizzesQuestion::with('answers.translations', 'translations')->get();
        $products = Product::all();
        return view('admin.combinations.create', compact('data', 'questions', 'products'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizzesQuestionsAnswersCombination  $quizzesQuestionsAnswersCombination
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCombinationRequest $request, $id)
    {
        DB::beginTransaction();

        $comb = QuizzesQuestionsAnswersCombination::findOrFail($id);
        $comb->name = $request->name;
        $comb->save();
        $answer_ids = [];
        $comb->answers()->delete();
        $comb->products()->delete();
        foreach ($request->answer_ids as $id) {
            if (!is_null($id)) $answer_ids[]["quizzes_questions_answer_id"] = $id;
        }
        $product_ids = [];
        foreach ($request->product_ids as $p) {
            $product_ids[]["product_id"] = $p;
        }
        $comb->answers()->createMany($answer_ids);
        $comb->products()->createMany($product_ids);

        DB::commit();

        session()->flash('update-message', 'Resource has been updated successfully.');
        return redirect(route("admin.combinations.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizzesQuestionsAnswersCombination  $quizzesQuestionsAnswersCombination
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        QuizzesQuestionsAnswersCombination::findOrFail($id)->delete();
        session()->flash('delete-message', 'Resource has been deleted successfully.');
        return redirect(route("admin.combinations.index"));
    }
}
