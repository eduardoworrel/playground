<?php

namespace App\Http\Middleware;

use Closure;

class CheckWhichUserIsLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userLogged = auth()->user();

        if($userLogged->papel !== 'cliente'){
            return redirect('/home');
        }
        return $next($request);
    }
}
