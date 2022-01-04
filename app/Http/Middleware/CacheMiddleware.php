<?php
/**
 *Author:Syskey
 *Date:2021/12/30
 *Time:15:31
 **/


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;


class CacheMiddleware
{

    public function handle($request, Closure $next)
    {
        if ($request->isMethod("get")&&webconfig("cache")==1) {
            $cachekey = md5(trim($request->getUri(),"/"));
            if (Cache::has($cachekey)) {
                return \response(Cache::get($cachekey));
            }
            $response = $next($request);
            $html = $response->getContent();
            Cache::forever($cachekey, $html);
            return $response;
        }
        return $next($request);
    }
}
