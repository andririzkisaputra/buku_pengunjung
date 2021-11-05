<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-tambah-anggota">
  <h1><?= Html::encode($this->title) ?></h1>
  <div class="row">
    <?php if (!$is_edit): ?>
      <div class="col-lg-6">
        <div class="tambah-anggota-img"></div>
      </div>
    <div class="col-lg-6">
      <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
      ]); ?>
        <?= $form->field($model, 'nama') ?>
        <?= $form->field($model, 'gambar')->fileInput(['class' => 'btn btn-primary', 'accept' => 'image/*', 'capture' => 'camera']) ?>
        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
      <?php ActiveForm::end(); ?>
    </div>
    <?php endif; ?>

    <?php if ($is_edit && $data): ?>
      <div class="col-lg-12">
        <?php $form = ActiveForm::begin([
          'id' => 'login-form',
          'options' => ['class' => 'form-horizontal'],
        ]); ?>
          <?= $form->field($model, 'anggota_id')->textInput(['value' => $data['anggota_id'], 'hidden' => true])->label(false) ?>
          <?= $form->field($model, 'nomor_anggota')->textInput(['value' => $data['nomor_anggota'], 'readonly' => true]) ?>
          <?= $form->field($model, 'nama')->textInput(['value' => $data['nama']]) ?>
          <?php echo Html::img('@web/uploads/thumb_'.$data['gambar'], ['class' => 'detail-img']);?>
          <?= $form->field($model, 'gambar')->fileInput(['class' => 'btn btn-primary', 'accept' => 'image/*', 'capture' => 'camera'])->label(false) ?>
          <div class="form-group">
              <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
          </div>
        <?php ActiveForm::end(); ?>
      </div>
    <?php endif; ?>

  </div>
</div>
