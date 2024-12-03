<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, ...$roles)
  {
    // Check if the user is authenticated
    if (!Auth::check()) {
      return redirect('/login');
    }

    $user = Auth::user();

    // Check if the user has one of the required roles
    if (!in_array($user->role->name, $roles)) {
      abort(403); // or return an error response
    }

    return $next($request);
  }
}
