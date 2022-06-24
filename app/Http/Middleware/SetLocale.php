<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;

class SetLocale
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
        $lang = $request->lang;

        if(!is_null($lang) && Language::where("language_code", $lang)->exists()) {
            app()->setLocale($lang);
            return $next($request);
        } elseif (is_null($lang)) {
            return $next($request);
        }
        abort(404);
    }
}
