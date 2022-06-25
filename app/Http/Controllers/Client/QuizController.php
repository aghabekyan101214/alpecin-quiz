<?php


namespace App\Http\Controllers\Client;


use App\Http\Requests\QuizAnswerQuestionRequest;
use App\Models\DependingQuestion;
use App\Models\Language;
use App\Models\QuizzesQuestion;
use App\Models\QuizzesQuestionsAnswersCombinationsProducts;
use App\Models\QuizzesUsedDependingQuestion;
use App\Models\QuizzesUsersAnswer;
use App\Models\QuizzesUsersFeedback;
use App\Models\QuizzesUsersState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Question\Question;

class QuizController
{
    public function index(Request $request)
    {
        return view('quiz.start');
    }

    public function start(Request $request)
    {
        $unique_id = uniqid() . time();
        $first_question = QuizzesQuestion::orderBy("order")->first();

        QuizzesUsersState::create(["session_id" => $unique_id, "question_id" => $first_question->id]);
        return redirect(route("quiz.get_question", ["lang" => app()->getLocale(), "session_id" => $unique_id]));
    }

    public function answer_question(QuizAnswerQuestionRequest $request)
    {
        DB::beginTransaction();
        $question = $this->get_question_by_session_id($request->session_id);
        QuizzesUsersAnswer::create(["session_id" => $request->session_id, "question_id" => $request->question_id, "answer_id" => $request->answer_id]);

        $depending_question = $this->get_depending_questions($request->session_id, $request->answer_id);

        if (!is_null($depending_question)) {
            $this->update_quiz_users_state($request->session_id, $depending_question->question_id);
            QuizzesUsedDependingQuestion::create(["session_id" => $request->session_id, "depending_question_id" => $depending_question->id]);
            DB::commit();
            return redirect(route("quiz.get_question", ["lang" => app()->getLocale(), "session_id" => $request->session_id]));
        }

        $dep_question_ids = DependingQuestion::all()->pluck("question_id")->toArray();
        $next_question = QuizzesQuestion::whereNotIn("id", $dep_question_ids)->where('order', '>', $question->question->order)->first();

        if (is_null($next_question)) {
            $this->handle_quiz_end($request->session_id);
            DB::commit();
            return redirect(route("quiz.quiz_result", ["lang" => app()->getLocale(), "session_id" => $request->session_id]));
        }
        $this->update_quiz_users_state($request->session_id, $next_question->id);
        DB::commit();
        return redirect(route("quiz.get_question", ["lang" => app()->getLocale(), "session_id" => $request->session_id]));

    }

    private function handle_quiz_end($session_id)
    {
        QuizzesUsersState::where("session_id", $session_id)->delete();
        QuizzesUsedDependingQuestion::where("session_id", $session_id)->delete();
        QuizzesUsersFeedback::create(["session_id" => $session_id, "combination_id" => $this->get_combination($session_id)]);
    }

    public function get_combination($session_id)
    {
        $group_concat_all_combinations_query = "SELECT quizzes_questions_answers_combination_id, GROUP_CONCAT(quizzes_questions_answer_id SEPARATOR ',') answer_ids_set FROM (SELECT * FROM quizzes_questions_answers_combinations_quizzes_questions_answers ORDER BY `quizzes_questions_answer_id`) t1
        GROUP BY quizzes_questions_answers_combination_id";
        $group_concat_current_answers_query = "SELECT GROUP_CONCAT(answer_id SEPARATOR ',') FROM (SELECT * FROM quizzes_users_answers ORDER BY answer_id) t2 WHERE session_id = '".$session_id."' GROUP BY session_id";
        $comb = DB::select("SELECT quizzes_questions_answers_combination_id FROM ($group_concat_all_combinations_query) t1 WHERE t1.answer_ids_set = ($group_concat_current_answers_query) ");
        if(count($comb)) {
            return $comb[0]->quizzes_questions_answers_combination_id;
        } else {
            abort(404);
        }
    }

    public function quiz_result(Request $request, $lang, $session_id)
    {
        $products = QuizzesUsersFeedback::where("session_id", $session_id)->with("combination.products.product.current_language")->first();
        return view("quiz.result", compact('products'));

    }

    private function update_quiz_users_state($session_id, $depending_question_id)
    {
        QuizzesUsersState::where(["session_id" => $session_id])->update(["question_id" => $depending_question_id]);
    }

    private function get_depending_questions($session_id, $answer_id)
    {
        $used_depending_questions = QuizzesUsedDependingQuestion::where("session_id", $session_id)->get();
        $used_depending_questions_ids = $used_depending_questions->pluck('depending_question_id')->toArray();

        return DependingQuestion::where("answer_id", $answer_id)->whereNotIn('id', $used_depending_questions_ids)->first();
    }

    public function get_question(Request $request, $lang, $session_id)
    {
        $question = $this->get_question_by_session_id($session_id);
        return view("quiz.quiz", compact("question", 'session_id'));
    }

    private function get_question_by_session_id($session_id)
    {
        $question = QuizzesUsersState::where("session_id", $session_id)->with("question.current_language", "question.answers.current_language")->first();
        if (is_null($question)) abort(404);
        return $question;
    }
}
