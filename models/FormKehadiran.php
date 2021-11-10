<?php

namespace app\models;

use Yii;
use yii\base\Model;

class FormKehadiran extends Model {

  public $nomor_anggota;

  public function rules() {
    return [
      ['nomor_anggota', 'required']
    ];
  }

  public function simpan_kehadiran() {
    if ($this->validate()) {
      $api = new Api;
      $simpan = $api->simpan_kehadiran($this->nomor_anggota, Yii::$app->user->identity->user_id);
      return ($simpan['status'] == 'success') ? true : false;
    } else {
      return false;
    }
  }

}
