<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Language
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
        $currentLocale="";
        foreach (config('app.locales') as $k => $locale) {
            if($k!=$request->segment(1)){
                $locale = App::currentLocale();
                $currentLocale=$locale;
                App::setLocale($locale);

            }else{
                $currentLocale=$request->segment(1);
                App::setLocale($request->segment(1));
            }
        }
        Session::put('locale', $locale);

        return $next($request);
    }
}
