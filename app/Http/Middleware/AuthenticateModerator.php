<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateModerator
{
  public function handle($request, Closure $next)
  {
    $user = Auth::user();
    // Allow moderators or admins to access
    if($user->role != 1 && $user->role != 2) {
      return redirect('/');
    }

    return $next($request);
  }
}
