<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<?php

$this->registerjs("
  let check = false;
  (function (a) {
      if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)))
          check = true;
  })(navigator.userAgent || navigator.vendor || window.opera);

   Webcam.set({
    width: 250,
    height: 250,
    dest_width: 720,
    dest_height: 720,
    image_format: 'jpeg',
    jpeg_quality: 100
  });
  Webcam.attach('#my_camera');

  $('#camera_front').on('click', function(){
    setTimeout(function() {
      Webcam.reset();
      Webcam.set({
          width: 250,
          height: 250,
          dest_width: 720,
          dest_height: 720,
          image_format: 'jpeg',
          jpeg_quality: 100
      });
      Webcam.set('constraints',{
          facingMode: 'constraint'
      });
      Webcam.attach('#my_camera');
    }, 500);
  });

  $('#camera_back').on('click', function(){
    setTimeout(function() {
      Webcam.reset();
      Webcam.set({
          width: 250,
          height: 250,
          dest_width: 720,
          dest_height: 720,
          image_format: 'jpeg',
          jpeg_quality: 100
      });
      Webcam.set('constraints',{
          facingMode: 'environment'
      });
      Webcam.attach('#my_camera');
    }, 500);
  });

$('#snapshot_btn').on('click', function(){
    console.log('Freeze Frame');
    Webcam.freeze();
    $('#post_take_btn').show();
    $('#pre_take_btn').hide();
});

$('#upload_btn').on('click', function(){
    Webcam.snap(function(data_uri){
        $('#uploadimagekycform-file').val(data_uri);
        let image_data_url = data_uri;
    });
    $.ajax({
      type:'POST',
      url:'upload-gambar',
      data:{
        'gambar' : image_data_url,
        'nama'   : 'Andri'
      },
      success:function(response){
          console.log('success');
      },
      error:function(){
          console.log('error');
      }
    });
    $('#post_take_btn').hide();
    $('#pre_take_btn').show();
});

$('#reset_btn').on('click', function(){
  console.log('Unfreeze Frame');
  Webcam.unfreeze();
  $('#post_take_btn').hide();
  $('#pre_take_btn').show();
});

");
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
        <div id="my_camera"></div>
        <br/>
        <br/>
        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
      <?php ActiveForm::end(); ?>
      <div class="form-group">
          <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary', 'name' => 'signup-button', 'id' => 'snapshot_btn']) ?>
          <?= Html::submitButton('Upload', ['class' => 'btn btn-primary', 'name' => 'signup-button', 'id' => 'upload_btn']) ?>
      </div>
      <div class="form-group">
          <?= Html::submitButton('Kamera Depan', ['class' => 'btn btn-primary', 'name' => 'signup-button', 'id' => 'camera_front']) ?>
          <?= Html::submitButton('Kamera Belakang', ['class' => 'btn btn-primary', 'name' => 'signup-button', 'id' => 'camera_back']) ?>
      </div>
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
          <?= $form->field($model, 'nama')->textInput(['value' => $data['nama'], 'id' => 'nama']) ?>
          <?php
          // $form->field($model, 'gambar')->fileInput(['class' => 'btn btn-primary', 'accept' => 'image/*', 'capture' => 'camera'])->label(false) ?>
          <div class="form-group">
            <a id="start-camera" class="btn btn-primary">Depan</a>
            <a id="back-camera" class="btn btn-primary">Belakang</a>
            <a id="stop-camera" class="btn btn-primary">Refresh</a>
            <a id="reload-camera" class="btn btn-primary">Ulang</a>
            <a id="click-photo" class="btn btn-primary">Click Photo</a>
          </div>
          <video id="video" width="600" height="410" autoplay></video>
          <div class="form-group">
            <?php if ($mobile): ?>
              <canvas id="canvas" width="510" height="700"></canvas>
            <?php endif; ?>
            <?php if (!$mobile): ?>
              <canvas id="canvas" width="600" height="410"></canvas>
            <?php endif; ?>
          </div>
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


<!-- <script type="text/javascript">
  $( document ).ready(function() {
    $('#click-photo').hide();
    $('#canvas').hide();
    $('#stop-camera').hide();
    $('#reload-camera').hide();
    $('#video').hide();
  });
  let camera_button = document.querySelector("#start-camera");
  let video         = document.querySelector("#video");
  let click_button  = document.querySelector("#click-photo");
  let canvas        = document.querySelector("#canvas");
  let back_camera   = document.querySelector("#back-camera");
  let stop          = document.querySelector("#stop-camera");

  $( "#start-camera" ).click(async function() {
    let stream = await navigator.mediaDevices.getUserMedia({
      video :
        {
          minAspectRatio: 5.000,
          minFrameRate: 60,
          width: 640,
          heigth: 480
        },
      audio : false
    });
  	video.srcObject = stream;
    $('#stop-camera').show();
    $('#click-photo').show();
    $('#video').show();
    $('#canvas').hide();
    $('#start-camera').hide();
    $('#back-camera').hide();
  });

  $( "#click-photo" ).click(async function() {
    $('#video').hide();
    $('#click-photo').hide();
    $('#stop-camera').hide();
    $('#reload-camera').show();
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

  $( "#back-camera" ).click(async function() {
    let stream = await navigator.mediaDevices.getUserMedia({
      video : {
        facingMode: 'environment'
      },
      audio : false
    });
    video.srcObject = stream;
    $('#click-photo').show();
    $('#stop-camera').show();
    $('#video').show();
    $('#canvas').hide();
    $('#start-camera').hide();
    $('#back-camera').hide();
  });

  $("#stop-camera" ).click(async function() {
    location.reload();
  });

  $("#reload-camera" ).click(async function() {
    $('#click-photo').show();
    $('#stop-camera').show();
    $('#video').show();
    $('#canvas').hide();
    $('#reload-camera').hide();
  });

</script> -->
