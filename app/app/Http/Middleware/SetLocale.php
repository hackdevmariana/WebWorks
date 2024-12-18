<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        
        $locale = $request->get('lang', config('app.locale')); 
        App::setLocale($locale);

        return $next($request);
    }
}
