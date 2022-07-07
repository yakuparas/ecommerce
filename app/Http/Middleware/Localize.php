<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class Localize
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

        if (!in_array($request->locale,config('app.available_locales')))
        {
            $base=url()->to('');
            $segments=$request->segments();
            return redirect()->to($base.'/'.config('app.locale').'/'.implode('/',$segments));
        }
        app()->setLocale($request->locale);
        URL::defaults(['locale'=>$request->locale]);
        return $next($request);

    }
}
