<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isUser
{
   
    public function handle(Request $request, Closure $next)
    {
        if(!$request->user()->hasRole('employee'))
        {
            abort(404);
        }

    }
}
