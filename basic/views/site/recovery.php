<?php
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
 ?>

<section class="background"> <!-- orange back -->
  <div class="container cont" style="text-align:center;"> <!-- center -->
    <div class="content-down container"> <!-- white back -->
      <div class="col-md-3"></div>
      <div class="col-md-6" >
        <h1> Авторизация</h1>
        <?php $form = ActiveForm::begin(); ?>
          <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('Введите вашу почту') ?>
          <div class="form-group">
            <?= Html::submitButton('Продолжить', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
          </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</section>
