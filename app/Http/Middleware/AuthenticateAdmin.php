<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
{
  public function handle($request, Closure $next)
  {
    $user = Auth::user();
    if($user->role != 2) {
      return redirect('/');
    }

    return $next($request);
  }
}
