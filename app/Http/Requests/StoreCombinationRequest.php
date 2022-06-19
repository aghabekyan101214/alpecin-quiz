<?php

namespace App\Http\Requests;

use App\Models\QuizzesQuestionsAnswersCombination;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\QuizzesQuestionsAnswersCombinationsQuizzesQuestionsAnswer;

class StoreCombinationRequest extends FormRequest
{
    use ValidationErrorHelper;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        $this->check_answers($request->answer_ids);
        $this->check_combination($request);
        $update_name = $request->method == 'PUT' ? "," . $request->route()->combination : '';
        return [
            "product_ids.*" => "required|exists:products,id",
            "name" => "required|unique:quizzes_questions_answers_combinations,name" . $update_name,
            "answer_ids.*" => "exists:quizzes_questions_answers,id|nullable"
        ];
    }

    private function check_combination($request)
    {
        // Check if the selected combination is already saved
        $answer_ids = [];
        foreach ($request->answer_ids as $id) {
            if (!is_null($id)) $answer_ids[] = $id;
        }

        // get the combinations from db with count of chosen ids
        $q = QuizzesQuestionsAnswersCombination::whereHas('answers', function ($query) use ($answer_ids) {
            $query->whereIn("quizzes_questions_answer_id", $answer_ids);
        })->withCount('answers')->having('answers_count', '=', count($answer_ids))->with('answers');
        if($request->method == 'PUT') {
            $q = $q->where("id", "!=", $request->route()->combination);
        }
        $data = $q->get();
        foreach ($data as $d) {
            $count_corresponding_ids = 0;
            foreach ($d->answers as $answer) {
                if(in_array($answer->quizzes_questions_answer_id, $answer_ids)) $count_corresponding_ids++;
            }
            if ($count_corresponding_ids >= count($answer_ids)) $this->throw_error('general', "This combination of answers has already been chosen. Please check and correct");
        }
    }

    private function check_answers($answers)
    {
        foreach ($answers as $a)
        {
            if (!is_null($a)) return;
        }
        $this->throw_error('general', "You should choose at least 1 answer");

    }
}
