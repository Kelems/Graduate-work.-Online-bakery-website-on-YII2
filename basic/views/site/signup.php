<?php
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
 ?>

 <section class="intro-section spad">
   <div class="container">
     <h1> Регистрация</h1>
     <?php $form=ActiveForm::begin()?>
     <?= $form->field($registration, 'email')->textInput()->label('Почта');?>
     <?= $form->field($registration, 'phone')->widget(\yii\widgets\MaskedInput::className(),['mask'=> '+7 (999) 999 99 99'])->label('Номер телефона');?>
     <?= $form->field($registration, 'password')->passwordInput()->label('Пароль');?>

    <div class ="form-group">
      <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success']) ?>
    </div>

  </div>
  <?php ActiveForm::end() ?>
</section>
