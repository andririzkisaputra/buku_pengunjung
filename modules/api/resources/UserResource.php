<?php
namespace app\modules\api\resources;

use app\models\User;

class UserResource extends User {
  public function fields() {
    $response = [
      // 'nama',
      'access_token',
      'token_type',
      'expires_in',
      'scope',
      'refresh_token',
      // 'user_id',
      // 'username',
    ];
    return $response;
  }
}

?>
