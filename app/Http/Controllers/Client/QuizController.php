<?php


namespace App\Http\Controllers\Client;


use App\Http\Requests\QuizAnswerQuestionRequest;
use App\Models\DependingQuestion;
use App\Models\Language;
use App\Models\QuizzesQuestion;
use App\Models\QuizzesUsedDependingQuestion;
use App\Models\QuizzesUsersState;
use Illuminate\Http\Request;
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
        $question = $this->get_question_by_session_id($request->session_id);

        $depending_question = $this->get_depending_questions($request->session_id, $request->answer_id);

        if (!is_null($depending_question)) {
            $this->update_quiz_users_state($request->session_id, $depending_question->question_id);
            QuizzesUsedDependingQuestion::create(["session_id" => $request->session_id, "depending_question_id" => $depending_question->id]);
            return redirect(route("quiz.get_question", ["lang" => app()->getLocale(), "session_id" => $request->session_id]));
        }

        $dep_question_ids = DependingQuestion::all()->pluck("question_id")->toArray();
        $next_question = QuizzesQuestion::whereNotIn("id", $dep_question_ids)->where('order', '>', $question->question->order)->first();

        if (is_null($next_question)) {
            dd("quiz ended");
        }
        $this->update_quiz_users_state($request->session_id, $next_question->id);
        return redirect(route("quiz.get_question", ["lang" => app()->getLocale(), "session_id" => $request->session_id]));

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
