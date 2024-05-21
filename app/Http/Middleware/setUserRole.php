<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class setUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role_name = "guest";
        if (Auth::user() && Auth::user()->roles())
        {
            $role_name = Auth::user()->roles()->first()->name;
        }
        $request->session()->put("role",Role::where("name",$role_name)->first());
        return $next($request);
    }
}
