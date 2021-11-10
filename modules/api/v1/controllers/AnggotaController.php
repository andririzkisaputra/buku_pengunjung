<?php
namespace app\modules\api\v1\controllers;

use Yii;
use app\modules\api\v1\resources\AnggotaResource;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use app\models\Anggota;
use app\models\User;
use app\models\Api;
use yii\helpers\Url;
// use yii\authclient\OAuth2;
//
// use yii\helpers\ArrayHelper;
// use yii\filters\auth\QueryParamAuth;
// use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
// use filsh\yii2\oauth2server\filters\auth\CompositeAuth;

class AnggotaController extends ActiveController {

  public $modelClass = AnggotaResource::class;

  public function behaviors() {
    $behaviors = parent::behaviors();
    $behaviors['authenticator']['authMethods'] = [
      HttpBearerAuth::class
    ];

    return $behaviors;
  }

  public function actionPost() {
    $get   = Yii::$app->request->post();
    $user  = User::find()->select('user_id')->where(['auth_key' => $get['key']])->one();
    $where = "created_by = {$user->user_id}";
    $model = new Anggota;
    $query = new Api;
    $data = $query->simpan_anggota($model, $get);
    return $data;
  }

  public function actionGet() {
    $baseUrl = Url::base('http');
    $get   = Yii::$app->request->post();
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

  public function actionDel() {
    $anggota_id = Yii::$app->request->get();
    $post       = Yii::$app->request->post();
    $query = new Api;
    $data = $query->delete_anggota($anggota_id, false, false, $post['key']);
    return $data;
  }

  public function actionPut() {
    $anggota_id = Yii::$app->request->get();
    $post       = Yii::$app->request->post();
    $query = new Api;
    $user  = User::find()->select('user_id')->where(['auth_key' => $post['key']])->one();
    $data  = $query->update_anggota($anggota_id['kode'], $post, $user->user_id);
    return $data;
  }
}

?>
