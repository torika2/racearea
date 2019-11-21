<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Factory as Auth;
use Closure;
use Cache;
use Carbon\Carbon;

class CheckUserOnlineOffline
{
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;


    }
    
  public function handle($request, Closure $next)
    {
        //  if ($this->auth->check() && $this->auth->user()->last_activity < Carbon::now()->subMinutes(5)->format('Y-m-d H:i:s')) {
        //      $user = $this->auth->user();
        //      $user->last_activity = new \DateTime;
        //      $user->timestamps = false;
        //      $user->save();
        // }
        return $next($request);
    }
}
