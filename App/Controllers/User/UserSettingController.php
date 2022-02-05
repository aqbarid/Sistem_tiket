<?php
namespace App\Controllers\User;
use Illuminate\Http\Request;
use App\Controllers\BaseController;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;

class UserSettingController extends BaseController {
  
  public function show(User $usr) {
    $user = $usr->auth();
    return $this->view('user.setting', ['user' => $user]);
  }

  public function update(Request $request) {
    $request = (object) $request->capture()->all();
    $action  = isset($request->_action) ? $request->_action : null;

    if($action == 'detail') {
      return $this->updateDetail($request);
    } elseif($action == 'password') {
      return $this->updatePassword($request);
    }

    return $this->redirect('/user/setting');
  }

  public function updateDetail($request) {
    
    $validate = $this->validate((array) $request, [
      'email' => 'required|email',
      'name' => 'required',
      'address' => 'required',
      'phone' => 'required'
    ]);

    if($validate->fail()) {
      $this->flashSession('error', $validate->firstError());
      return $this->redirect('/user/setting');
    }

    (new User)->updateDetail([$request->email, $request->name, $request->address, $request->phone]);
    $this->flashSession('success', 'Account Updated');
    return $this->redirect('/user/setting');
  }

  public function updatePassword($request) {
    $user = (new User)->auth();

    $validate = $this->validate((array) $request, [
      'old_password' => 'required',
      'new_password' => 'required',
      'confirm_password' => 'required|same:new_password',
    ]);

    if($validate->fail()) {
      $this->flashSession('error', $validate->firstError());
      return $this->redirect('/user/setting');
    }

    $isOldPassIsValid = password_verify($request->old_password, $user->password);

    if(!$isOldPassIsValid) {
      $this->flashSession('error', 'Old password is invalid');
      return $this->redirect('/user/setting');
    }

    (new User)->updatePassword($request->new_password);

    $this->flashSession('success', 'Password Updated');
    return $this->redirect('/user/setting');
  }

}

