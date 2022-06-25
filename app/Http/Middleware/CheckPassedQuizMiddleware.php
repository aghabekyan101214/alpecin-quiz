<?php

namespace App\Http\Middleware;

use App\Models\QuizzesUsersFeedback;
use Closure;
use Illuminate\Http\Request;

class CheckPassedQuizMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $session_id = $request->method() == "POST" ? $request->session_id : $request->route()->session_id;
        if(QuizzesUsersFeedback::where(["session_id" => $session_id])->exists()) {
            return redirect(route("quiz.quiz_result", ["lang" => app()->getLocale(), "session_id" => $request->session_id]));
        }
        return $next($request);
    }
}
