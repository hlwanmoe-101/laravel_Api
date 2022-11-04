<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
//        $accessKey=['abc','def'];
//        if(!$request->has('key') || !in_array($request->key,$accessKey)){
//            return response()->json([
//                'message'=>"key require",
//                'error'=>'bar lar load tar lal'
//            ],403);
//        }

        return $next($request);
    }
}
