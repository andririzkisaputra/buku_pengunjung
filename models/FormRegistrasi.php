<?php

namespace app\models;

use Yii;
use yii\base\Model;

class FormRegistrasi extends Model {

  public $nama;
  public $username;
  public $email;
  public $password;

  public function rules() {
    return [
      ['nama', 'required'],
      ['nama', 'string', 'max' => 255],
      ['username', 'trim'],
      ['username', 'required'],
      ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
      ['username', 'string', 'min' => 2, 'max' => 255],
      ['email', 'trim'],
      ['email', 'required'],
      ['email', 'email'],
      ['email', 'string', 'max' => 255],
      ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
      ['password', 'required'],
      ['password', 'string', 'min' => 6],
    ];
  }

  public function registrasi() {

    if (!$this->validate()) {
        return null;
    }
    $security         = \Yii::$app->security;
    $user             = new User();
    $user->nama       = $this->nama;
    $user->username   = $this->username;
    $user->email      = $this->email;
    $user->token_type = 'Bearer';
    $user->scope      = 'app';
    $user->setPassword($this->password);
    $user->generateAuthKey();
    $user->client_id     = $security->generateRandomString(25);
    $user->client_secret = $security->generateRandomString(35);
    $user->created_at    = date('Y-m-d H:s:i');
    return $user->save() ? $user : null;
  }

}
