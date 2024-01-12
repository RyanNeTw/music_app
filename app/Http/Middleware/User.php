<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->header('x-api-key')) {
            abort(403, 'Unauthorized action.');
        } 

        $apiKeys = ApiKey::where('key', $request->header('x-api-key'))->get();

        if (!$apiKeys) {
            abort(403, 'Wrong API Key used.');
        }

        return $next($request);
    }
}