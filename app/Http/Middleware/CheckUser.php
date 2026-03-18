<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {     
        if(!auth('api')->check()){
            return response()->json(['message' => 'Non autorisé'], 401);
        }
        
    
    
       return $next($request);
    }
}
