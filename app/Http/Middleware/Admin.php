<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Resources\ApiResource;

class Admin
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
        if (auth()->user() && auth()->user()->role==1)
        {
            return $next($request);
        }

        return response()->json(new ApiResource(false,'Anda tidak memiliki akses'), 401);
    }
}
