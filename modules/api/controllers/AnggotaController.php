<?php
namespace app\modules\api\controllers;

use app\modules\api\resources\AnggotaResource;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\authclient\OAuth2;

use yii\helpers\ArrayHelper;
use yii\filters\auth\QueryParamAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;

class AnggotaController extends ActiveController {

  public $modelClass = AnggotaResource::class;

  public function behaviors() {
    return ArrayHelper::merge(parent::behaviors(), [
      'authenticator' => [
        'class' => CompositeAuth::className(),
        'authMethods' => [
          ['class' => HttpBearerAuth::className()],
          ['class' => QueryParamAuth::className(), 'tokenParam' => 'accessToken'],
        ]
      ],
      'exceptionFilter' => [
          'class' => ErrorToExceptionFilter::className()
      ],
    ]);
    // $behaviors = parent::behaviors();
    // $behaviors['authenticator'] = [
    //   'class' => CompositeAuth::className(),
    //   ['authMethods'] = [
    //     ['class' => HttpBearerAuth::className()],
    //     ['class' => QueryParamAuth::className(), 'tokenParam' => 'accessToken'],
    //   ]
    // ];
    //
    // return $behaviors;
  }

}

?>
