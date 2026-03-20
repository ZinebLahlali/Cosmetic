<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $user = auth('api')->user();

        if(!$user->load('role')->role || $user->role->name   !== "Employe"){
           return response()->json([
             'message' => 'Accés réservé aux employés'
           ], 403);
        }
        return $next($request);
    }
}
