<?php 
namespace App\Middlewares;
use Closure;

use App\Models\User;

class AuthMiddleware extends Middleware {
  public function handle($request, Closure $next) {

    $user = new User();

    $auth = $user->auth();


    if(!isset($auth->id)) {
      $this->flashSession('error', 'You must be login first');
      $this->redirect('/login');
    }

    if(
      str_starts_with($request->getPathInfo(), '/seller') && $auth->role !== 'seller' || 
      str_starts_with($request->getPathInfo(), '/user') && $auth->role !== 'user' ||
      str_starts_with($request->getPathInfo(), '/admin') && $auth->role !== 'admin'
    ) {
      $this->flashSession('error', 'Forbidend modules');
      $this->redirect('/');
    }


    return $next($request);
  }
}