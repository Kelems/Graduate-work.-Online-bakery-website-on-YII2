<?php
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
 ?>

<section class="background"> <!-- orange back -->
  <div class="container"> <!-- center -->
    <div class="cont"> <!-- -->
      <div class="content-down"> <!-- white back -->
        <div class="col-md-12">
        <div class="container">

            <div class="col-md-3"></div>
            <div class="col-md-6">
              <h1> Регистрация</h1>
              <?php $form=ActiveForm::begin()?>
              <?= $form->field($registration, 'email')->textInput()->label('Почта');?>
              <?= $form->field($registration, 'phone')->widget(\yii\widgets\MaskedInput::className(),['mask'=> '+7 (999) 999 99 99'])->label('Номер телефона');?>
              <?= $form->field($registration, 'password')->passwordInput()->label('Пароль');?>

              <div class ="form-group">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success']) ?>
              </div>
              <?php ActiveForm::end() ?>
            </div>


            </div>

      </div>
    </div>
  </div>
  </div>
</section>
