<?php 
namespace App\Middlewares;
use Closure;

class AuthMiddleware {
  public function handle($request, Closure $next) {
    return $next($request);
  }
}