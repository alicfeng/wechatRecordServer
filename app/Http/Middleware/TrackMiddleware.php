<?php
/**
 * Created by AlicFeng in 2017/12/22 18:08
 */

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Log;


class TrackMiddleware
{


    public function __construct()
    {

    }

    public function handle(Request $request, Closure $next)
    {
        Log::info('Track Access Message');
        Log::info('all : ' . json_encode($request->all(), JSON_UNESCAPED_UNICODE));
        Log::info('ip : ' . $request->ip());
        Log::info('method : ' . $request->method());
        Log::info('route actionMethod : ' . $request->route()->getActionMethod());
        Log::info('content : ' . $request->getContent());
        return $next($request);
    }

    public function terminate($request, $response)
    {
        //这里是响应后调用的方法(没有返回值)
    }
}