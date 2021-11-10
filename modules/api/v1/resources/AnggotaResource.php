<?php
namespace app\modules\api\v1\resources;

use app\models\Anggota;

class AnggotaResource extends Anggota {
  public function fields() {
    \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
    $response = [
      // 'status' => 'true',
      'anggota_id',
      'nama',
      'nomor_anggota',
      'gambar',
      'created_by',
      'created_at'
    ];

    return $response;
  }
}

?>
