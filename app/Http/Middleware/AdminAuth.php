<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('ADMIN_LOGIN')){  

        }
        else
        {
        $request->session()->flash('error','Access Denied !!! Not Login Is Reason');
        return redirect::to('admin');
        }
        return $next($request);
    }
}
