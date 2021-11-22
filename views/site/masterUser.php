<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\widgets\LinkPager;

$this->title = 'Home';
?>
<div class="site-index">
  <div class="row" style="margin-bottom: 10px">
    <div class="total-tamu" style="background-color: #20a8d8;">
      <h3 class="text-white font-weight-bold"><?= Html::encode($user_total) ?></h3>
      <p class="text-white">Total User</p>
    </div>
    <div class="total-tamu" style="background-color: #63c2de;">
      <h3 class="text-white font-weight-bold"><?= Html::encode($user_tahunan) ?></h3>
      <p class="text-white">Daftar Tahun Ini</p>
    </div>
    <div class="total-tamu" style="background-color: #f6ca04;">
      <h3 class="text-white font-weight-bold"><?= Html::encode($user_bulanan) ?></h3>
      <p class="text-white">Daftar Bulan Ini</p>
    </div>
    <div class="total-tamu" style="background-color: #f86c6b;">
      <h3 class="text-white font-weight-bold"><?= Html::encode($user_harian) ?></h3>
      <p class="text-white">Daftar Hari Ini</p>
    </div>
    <div class="layout-form-tamu">
        <h3 class="text-black font-weight-bold">Data User</h3>
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Waktu Daftar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($user) {
              $i = 1;
              foreach ($user as $value) : ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $value['nama']; ?></td>
                  <td><?php echo date('d M Y H:i:s', strtotime($value['created_at'])) ?></td>
                  <td class="form-group">
                    <?= Html::a('Hapus', ['site/hapus-user?id='.$value['user_id']], ['class' => 'btn btn-sm btn-danger']); ?>
                  </td>

                </tr>
              <?php endforeach; ?>
            <?php } ?>
          </tbody>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Waktu Daftar</th>
              <th>Aksi</th>
            </tr>
          </thead>
        </table>
        <?php

        if ($user_harian > 0) {
          echo LinkPager::widget([
            'pagination'         => $pages,
            'prevPageLabel'      => false,
            'nextPageLabel'      => false,
            'maxButtonCount'     => 2,
            'activePageCssClass' => 'active-page',
            'firstPageLabel'     => 'Prev',
            'firstPageCssClass'  => 'page-prev-last',
            'lastPageCssClass'   => 'page-prev-last',
            'pageCssClass'       => 'page-prev-last',
            'lastPageLabel'      => 'Next',
          ]);
        }
        ?>
      </div>
  </div>
</div>
