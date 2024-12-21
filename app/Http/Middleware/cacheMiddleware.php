<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class cacheMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();
        $cacheKey = 'user_' . $user->id;

        // if (!Cache::has($cacheKey)) {

        //     $userData = Cache::get($cacheKey);
        //     $request->attributes->add(['userData' => $userData, 'source' => 'Data fetched from cache']);

        //     $request->merge([
        //         'userID' => $user->id,
        //         'userName' => $user->name,
        //         'userEmail' => $user->email,
        //         'userRole' => $user->role, 
        //     ]);
        // } 

        $userData = Cache::remember($cacheKey, 3600, function() use ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ];
        });

        // Add the cached user data to the request
        $request->attributes->add(['userData' => $userData, 'source' => 'Data fetched from cache']);
        $request->merge([
            'userID' => $user->id,
            'userName' => $user->name,
            'userEmail' => $user->email,
            'userRole' => $user->role, 
        ]);
        return $next($request);
    }
}
