<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Command;
use yii\db\Query;
use yii\data\Pagination;

class Api extends Model {

  public function count_select($tabel, $where = false, $andWhere) {
    $count = new Query;
    $count->from($tabel);
    if ($where) {
      $count->where($where)->andWhere($andWhere);
    }
    return $count->count();
  }

  public function select_join($select, $tabel, $tabelJoin, $join, $where = false, $andWhere, $group_by = false) {
    $semua = new Query;
    $semua->select($select)->from($tabel)->leftJoin($tabelJoin, $join);
    if ($where) {
      $semua->where($where)->andWhere($andWhere);
    }
    if ($group_by) {
      $semua->groupBy($group_by);
    }
    $semua->orderBy(['created_at' => SORT_DESC]);
    $countQuery = clone $semua;
    $pages = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => 1]);
    $semua->offset($pages->offset)->limit($pages->limit);
    if ($semua->all()) {
      $response = [
        'isStatus' => true,
        'status'   => 'success',
        'pages'    => $pages,
        'data'     => $semua->all(),
        'message'  => 'data berhasil diambil'
      ];
    } else {
      $response = [
        'isStatus' => false,
        'status'   => 'error',
        'pages'    => 'success',
        'data'     => '',
        'message'  => 'gagal mengambil data'
      ];
    }
    return $response;
  }

  public function select_tabel($select, $tabel, $where = false, $group_by = false) {
    $semua = new Query;
    $semua->select($select)->from($tabel);
    if ($where) {
      $semua->where($where);
    }
    if ($group_by) {
      $semua->groupBy($group_by);
    }
    $semua->orderBy(['created_at' => SORT_DESC]);
    $countQuery = clone $semua;
    $pages = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => 5]);
    $semua->offset($pages->offset)->limit($pages->limit);
    if ($semua->all()) {
      $response = [
        'isStatus' => true,
        'status'   => 'success',
        'pages'    => $pages,
        'data'     => $semua->all(),
        'message'  => 'data berhasil diambil'
      ];
    } else {
      $response = [
        'isStatus' => false,
        'status'   => 'error',
        'pages'    => 'success',
        'data'     => '',
        'message'  => 'gagal mengambil data'
      ];
    }
    return $response;
  }

  public function select_tabel_row($select, $tabel, $where = false) {
    $semua = new Query;
    $semua->select($select)->from($tabel);
    if ($where) {
      $semua->where($where);
    }
    if ($semua->one()) {
      $response = [
        'isStatus' => true,
        'status'   => 'success',
        'data'     => $semua->one(),
        'message'  => 'data berhasil diambil'
      ];
    } else {
      $response = [
        'isStatus' => false,
        'status'   => 'error',
        'data'     => '',
        'message'  => 'gagal mengambil data'
      ];
    }
    return $response;
  }

  public function simpan_kehadiran($nomor_anggota, $user_id) {
    $cek_data = $this->count_select('anggota', array('=', 'nomor_anggota', $nomor_anggota), array('=', 'created_by', $user_id));
    if ($cek_data) {
      $insert = new Kehadiran;
      $insert->nomor_anggota = $nomor_anggota;
      $insert->created_by    = $user_id;
      $insert->created_at    = date('Y-m-d H:s:i');
      $insert->save();
      if ($insert) {
        $response = [
          'isStatus' => true,
          'status'   => 'success',
          'data'     => $insert,
          'message'  => 'data berhasil disimpan'
        ];
      } else {
        $response = [
          'isStatus' => false,
          'status'   => 'error',
          'data'     => '',
          'message'  => 'gagal menyimpan data'
        ];
      }
    } else {
      $response = [
        'isStatus' => false,
        'status'   => 'error',
        'data'     => '',
        'message'  => 'belum terdaftar anggota'
      ];
    }
    return $response;
  }

  public function update_anggota($anggota_id, $data, $user_id) {
    $semua = new Query;
    $cek_data = $semua->from('anggota')->where(['=', 'anggota_id', $anggota_id])->andWhere(['=', 'created_by', $user_id])->one();
    if ($cek_data) {
      if ($data['gambar']) {
        $baseUrl = Yii::$app->getBasePath();
        unlink($baseUrl.'/uploads/'.$cek_data['gambar']);
        unlink($baseUrl.'/uploads/thumb_'.$cek_data['gambar']);
        $update = Anggota::findOne([
          'anggota_id' => $anggota_id,
        ]);
        $update->nama        = $data['nama'];
        $update->gambar      = $data['gambar'];
        $update->modified_on = date('Y-m-d H:s:i');
      } else {
        $update = Anggota::findOne([
          'anggota_id' => $anggota_id,
        ]);
        $update->nama        = $data['nama'];
        $update->modified_on = date('Y-m-d H:s:i');
      }
      $update->save();
      if ($update) {
        $response = [
          'isStatus' => true,
          'status'   => 'success',
          'data'     => $update,
          'message'  => 'data berhasil diubah'
        ];
      } else {
        $response = [
          'isStatus' => false,
          'status'   => 'error',
          'data'     => '',
          'message'  => 'gagal mengubah data'
        ];
      }
    } else {
      $response = [
        'isStatus' => false,
        'status'   => 'error',
        'data'     => '',
        'message'  => 'data tidak bisa diubah'
      ];
    }
    return $response;
  }

  public function delete_anggota($anggota_id, $user_id, $gambar) {
    $cek_data = $this->count_select('anggota', array('=', 'anggota_id', $anggota_id), array('=', 'created_by', $user_id));
    if ($cek_data) {
      $delete = Anggota::findOne([
        'anggota_id' => $anggota_id,
      ]);
      $baseUrl = Yii::$app->getBasePath();
      unlink($baseUrl.'/uploads/'.$gambar);
      unlink($baseUrl.'/uploads/thumb_'.$gambar);
      $delete->delete();
      if ($delete) {
        $response = [
          'isStatus' => true,
          'status'   => 'success',
          'data'     => $delete,
          'message'  => 'data berhasil dihapus'
        ];
      } else {
        $response = [
          'isStatus' => false,
          'status'   => 'error',
          'data'     => '',
          'message'  => 'gagal menghapus data'
        ];
      }
    } else {
      $response = [
        'isStatus' => false,
        'status'   => 'error',
        'data'     => '',
        'message'  => 'data tidak bisa diubah'
      ];
    }
    return $response;
  }

}
