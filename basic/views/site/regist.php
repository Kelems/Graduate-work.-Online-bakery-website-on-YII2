<?php
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
 ?>

<section class="background"> <!-- orange back -->
  <div class="container cont" style="text-align:center;"> <!-- center -->
    <div class="content-down container"> <!-- white back -->
      <div class="col-md-3"></div>
        <div class="col-md-6" >
        <h1> Регистрация</h1>
        <?php $form=ActiveForm::begin()?>
          <?= $form->field($registration, 'email')->textInput()->label('Почта');?>
          <?= $form->field($registration, 'phone')->widget(\yii\widgets\MaskedInput::className(),['mask'=> '+7 (999) 999 99 99'])->label('Номер телефона');?>
          <?= $form->field($registration, 'password')->passwordInput()->label('Пароль');?>
          <div class ="form-group" style="text-align:center;">
            <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success']) ?>
          </div>
        <?php 
        ActiveForm::end() ?>
        <a  href="http://yii-2-bakery/basic/web/index.php/site/login">уже зарегистрированы?</a>
      </div>
    </div>
  </div>
</section>
 