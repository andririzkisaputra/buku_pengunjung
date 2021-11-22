<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
?>
<div class="site-signup form-data">
  <h1><?= Html::encode($this->title) ?></h1>
  <div class="row">
    <div class="col-lg-12" >
      <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
      ]); ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'rememberMe', [
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ])->checkbox() ?>
        <div class="form-group">
          <?= Html::a('Allow', ['oauth2/token'], ['class' => 'btn btn-primary']); ?>
          <?= Html::a('Deny', ['oauth2/callback'], ['class' => 'btn btn-light']); ?>
        </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
