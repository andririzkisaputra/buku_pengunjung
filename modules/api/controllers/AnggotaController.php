<?php
namespace app\modules\api\controllers;

use Yii;
use app\modules\api\resources\AnggotaResource;
use app\modules\api\resources\UsesrResource;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use app\models\Anggota;
use app\models\User;
use app\models\Api;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
// use yii\authclient\OAuth2;
//
// use yii\helpers\ArrayHelper;
// use yii\filters\auth\QueryParamAuth;
// use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
// use filsh\yii2\oauth2server\filters\auth\CompositeAuth;

class AnggotaController extends ActiveController {

  public $modelClass     = AnggotaResource::class;
  public $modelClassUser = UsesrResource::class;

  public function behaviors() {
    $behaviors = parent::behaviors();
    $behaviors['authenticator']['authMethods'] = [
      HttpBearerAuth::class
    ];
    return $behaviors;
  }

  public function actions()
  {

    return array_merge(
      parent::actions(),
      [
        'index' => [
          'class'          => 'yii\rest\IndexAction',
          'modelClass'     => $this->modelClass,
          'checkAccess'    => [$this, 'checkAccess'],
          'prepareDataProvider' => function ($action) {
            $baseUrl = Url::base('http');
            $get   = Yii::$app->request->get();
            $query = new Api;
            $user  = User::find()->select('user_id')->where(['auth_key' => $get['key']])->one();
            $where = "created_by = {$user->user_id}";
            $data  = $query->select_tabel('*', 'anggota', $where, false, false);
            if ($data['data']) {
              foreach ($data['data'] as $key => $value) {
                $data['data'][$key]['gambar_link'] = $baseUrl.'/uploads/'.$data['data'][$key]['gambar'];
              }
            }
            return $data;
          }
        ],
        'create' => [
          'class'          => 'yii\rest\IndexAction',
          'modelClass'     => $this->modelClass,
          'checkAccess'    => [$this, 'checkAccess'],
          'prepareDataProvider' => function ($action) {
            $post  = Yii::$app->request->post();
            $model = new Anggota;
            $query = new Api;
            $data = $query->simpan_anggota($model, $post);
            return $data;
          }
        ],
        'delete' => [
          'class'          => 'yii\rest\IndexAction',
          'modelClass'     => $this->modelClass,
          'checkAccess'    => [$this, 'checkAccess'],
          'prepareDataProvider' => function ($action) {
            $get  = Yii::$app->request->get();
            $query = new Api;
            $data = $query->delete_anggota($get);
            return $data;
          }
        ],
      ]
    );
  }

}

?>
