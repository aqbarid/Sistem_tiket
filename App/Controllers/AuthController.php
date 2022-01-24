<?php

namespace App\Controllers;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;


use App\Models\User;

class AuthController extends BaseController {

  public function __construct()
  {
    parent::__construct();
  }

  public function register() {
    return $this->view('auth.register');
  }

  public function login() {
    return $this->view('auth.login');
  }

  public function postRegister(User $user) {
    $request  = (object) Request::capture()->all();


    $validate = $this->validate($request, [
      'name' => 'required',
      'email'  => 'required|email|unique:users,email',
      'phone'  => 'required',
      'address'  => 'required',
      'password'  => 'required',
      'role' => 'required|in:seller,customer'
    ]);


    if($validate->fail()) {
      $this->flashSession('error', $validate->firstError());
      $this->redirect('/register');
    }



    try {
      $user->register($request->email, $request->name, $request->address, $request->phone, $request->password, $request->role);
    } catch(\Exception $e) {
      $this->flashSession('error', 'Failed Register, please try another email');
      $this->redirect('/register');  
    }
    $this->flashSession('success', 'Register Success');
    $this->redirect('/login');
  }

  public function postLogin(User $user) {
    $request  = (object) Request::capture()->all();


    $validate = $this->validate($request, [
      'email'  => 'required|email',
      'password'  => 'required',
    ]);
    

    if($validate->fail()) {
      $this->flashSession('error', $validate->firstError());
      $this->redirect('/login');
    }

    try {
      $usr = $user->findBy('email', $request->email);

      if(password_verify($request->password, $usr->password)) {
        $sessionUUID = Uuid::uuid4()->toString();

        $user->updateToken([$sessionUUID, $usr->id]);

        $this->setSession('auth', $sessionUUID);
        if($usr->role == 'customer' || $usr->role == 'seller') {
          $this->redirect('/');
        } else if($user->role == 'admin') {
          $this->redirect('/admin');
        }
      }

      
    } catch(\Exception $e) {
      dd($e);
      $this->flashSession('error', 'User not found');
      $this->redirect('/login');
    }
    



    dd($user);

  }
}