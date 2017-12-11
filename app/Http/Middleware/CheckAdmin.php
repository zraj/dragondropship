<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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

        if (auth()->user()->user_type == config('constants.admintype')) {
             return $next($request);
        }else{
            // session()->flash('message','Not Authorize ! Admin Only');
            return redirect('home')->withErrors([config('constants.message.not_authorize').' ! Admin Only']);

        }

    }
}
