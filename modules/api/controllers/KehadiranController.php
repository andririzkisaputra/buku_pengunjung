<?php
namespace app\modules\api\controllers;

use app\modules\api\resources\KehadiranResource;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;

class KehadiranController extends ActiveController {

  public $modelClass = KehadiranResource::class;

  public function behaviors() {
    $behaviors = parent::behaviors();
    $behaviors['authenticator']['authMethods'] = [
      HttpBearerAuth::class
    ];

    return $behaviors;
  }

}

?>
