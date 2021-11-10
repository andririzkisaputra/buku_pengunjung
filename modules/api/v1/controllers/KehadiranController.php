<?php
namespace app\modules\api\v1\controllers;

use Yii;
use app\modules\api\v1\resources\KehadiranResource;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use app\models\Api;
use app\models\User;

class KehadiranController extends ActiveController {

  public $modelClass = KehadiranResource::class;

  public function behaviors() {
    $behaviors = parent::behaviors();
    $behaviors['authenticator']['authMethods'] = [
      HttpBearerAuth::class
    ];

    return $behaviors;
  }

  public function actionPost() {
    $baseUrl = Yii::$app->getBasePath();
    $post     = Yii::$app->request->post();
    $query   = new Api;
    $user    = User::find()->select('user_id')->where(['auth_key' => $post['key']])->one();
    $data    = $query->simpan_kehadiran($post['nomor_anggota'], $user->user_id);
    return $data;
  }

  public function actionGet() {
    $baseUrl     = Yii::$app->getBasePath();
    $get         = Yii::$app->request->post();
    $query       = new Api;
    $user        = User::find()->select('user_id')->where(['auth_key' => $get['key']])->one();
    $where       = "kehadiran.created_by = {$user->user_id} AND kehadiran.created_at LIKE '%".date('Y-m-d')."%'";
    $where_total = "kehadiran.created_by = {$user->user_id}";
    $where_tahun = "kehadiran.created_by = {$user->user_id} AND kehadiran.created_at LIKE '%".date('Y')."%'";
    $where_bulan = "kehadiran.created_by = {$user->user_id} AND kehadiran.created_at LIKE '%".date('Y-m')."%'";
    $total       = $query->select_join('*', 'kehadiran', 'anggota', 'kehadiran.nomor_anggota = anggota.nomor_anggota', $where_total, false,  'kehadiran.nomor_anggota', false);
    $tahun       = $query->select_join('*', 'kehadiran', 'anggota', 'kehadiran.nomor_anggota = anggota.nomor_anggota', $where_tahun, false,  'kehadiran.nomor_anggota', false);
    $bulan       = $query->select_join('*', 'kehadiran', 'anggota', 'kehadiran.nomor_anggota = anggota.nomor_anggota', $where_bulan, false,  'kehadiran.nomor_anggota', false);
    $kehadiran   = $query->select_join('*', 'kehadiran', 'anggota', 'kehadiran.nomor_anggota = anggota.nomor_anggota', $where, false,  'kehadiran.nomor_anggota', false);
    $data['data']['kehadiran'] = $kehadiran['data'];
    $data['data']['total']     = count($total['data']);
    $data['data']['tahun']     = count($tahun['data']);
    $data['data']['bulan']     = count($bulan['data']);
    $data['data']['hari']      = count($kehadiran['data']);
    return $data;
  }

}

?>
