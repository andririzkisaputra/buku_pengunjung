<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;

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
        <?= $form->field($model, 'nama')->textInput(['id' => 'nama']) ?>
        <div class="form-group">
          <a id="start-camera" class="btn btn-primary">Foto</a>
          <a id="click-photo" class="btn btn-primary">Click Photo</a>
        </div>
        <video id="video" width="320" height="240" autoplay></video>
        <div class="form-group" style="background-color:#cccccc; display: flex; justify-content: center;">
          <?php if ($mobile): ?>
            <canvas id="canvas" width="240" height="320"></canvas>
          <?php endif; ?>
          <?php if (!$mobile): ?>
            <canvas id="canvas" width="320" height="240"></canvas>
          <?php endif; ?>
        </div>
        <?php
        // $form->field($model, 'gambar')->fileInput(['class' => 'btn btn-primary', 'accept' => 'image/*', 'capture' => 'camera']) ?>
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
    <?php
      Modal::begin([
        'id'=>'modal',
        'size'=>'modal-md',
      ]);

      echo "<div id='modalContent'></div>";

      Modal::end();
    ?>
  </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
  $('#click-photo').hide();
  $('#canvas').hide();
});
let camera_button = document.querySelector("#start-camera");
let video = document.querySelector("#video");
let click_button = document.querySelector("#click-photo");
let canvas = document.querySelector("#canvas");

  camera_button.addEventListener('click', async function() {
    let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
  	video.srcObject = stream;
    $('#click-photo').show();
    $('#video').show();
    $('#canvas').hide();
  });

  click_button.addEventListener('click', function() {
    $('#video').hide();
    $('#click-photo').hide();
    $('#canvas').show();
   	canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
   	let image_data_url = canvas.toDataURL('image/jpeg').replace(/^data:image\/jpeg;base64,/, "");
    let nama           = $('#nama').val();
    $.ajax({
      type:'POST',
      url:"upload-gambar",
      data:{
        'gambar' : image_data_url,
        'nama'   : nama
      },
      success:function(response){
          console.log('success');
      },
      error:function(){
          console.log('error');
      }
    });
  });
</script>
