<?php
namespace App\Traits;

use Rakit\Validation\Validator;
use App\Rules\UniqueRule;


trait ValidatorTrait {

  protected $validate;

  public function validate($req, $rules) {
    $validator = new Validator;
    $validator->addValidator('unique', new UniqueRule($this->db));
    $this->validate =  $validator->make((array)$req, (array)$rules);
    $this->validate->validate();

    return $this;
  }

  public function fail() {
    return $this->validate->fails();
  }

  public function firstError() {
    $err = $this->validate->errors();
    $err2 = (array) $err->firstOfAll();
    return $err2[array_key_first($err2)];
  }

  public function allError() {
    $errors = $this->validate->errors();
    return $errors->toArray();
  }

}