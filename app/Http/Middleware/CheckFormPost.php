<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckFormPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $seconds = 3, $abortField = 'homepage', $timeField = '_t', $ipQuery=null)
    {
        if($request->isMethod('post')){
            $this->abortIfFieldIsSet($request, $abortField);
            $this->abortIfPostedInSeconds($request, $seconds, $timeField);
            //$this->abortIfPostedFromSameIPAddressInSeconds($request, $ipQuery, $seconds);
        }
        return $next($request);
    }


    private function abortIfFieldIsSet(Request $request, $abortField)
    {
        if (trim($request->{$abortField}) != '') {
            //TODO: Block IP
            abort(403);
        }
    }

    private function abortIfPostedInSeconds(Request $request, $seconds, $timeField)
    {
        try {
            $time = \Crypt::decrypt($request->{$timeField});
            // eger ote dereu (5 sekundtin ishinde) submit istegen bolsa
            if (is_numeric($time) && time() < ($time + $seconds)) {
                //TODO: Block IP
                abort(403);
            }
        } catch (\Illuminate\Encryption\DecryptException $exception) {
            abort(403);
        }
    }

    private function abortIfPostedFromSameIPAddressInSeconds(Request $request, $ipQuery, $seconds)
    {
        $ip = $request->ip();
        if ($ipQuery->where('ip', $ip)->where('created_at', '>=', Carbon::now()->subSeconds($seconds))->count()) {
            //TODO: Block IP
            abort(403);
        }
    }
}
